class Uploader {

    constructor(options = {}) {
        this.config = {
            chunkSize: 2 * 1024 * 1024,
            concurrentFiles: 3,
            maxFileSize: Infinity,
            ...options
        };

        this.files = new Map();
        this.uploading = false;
        this.concurrentFiles = 0;

        this.eventHandlers = {
            progress: new Set(),
            allCompleted: new Set(),
            uploadSuccess: new Set(),
            uploadError: new Set(),
            uploadStart: new Set(),
            fileAdded: new Set(),
            hashCalculated: new Set()
        };
    }

    removeFile(fileObj) {
        this.files.delete(fileObj.fileId)
    }

    clearFile() {
        this.files.clear()
    }

    addFile(file) {

        const fileId = this.generateFileId(file);
        const chunkTotal = Math.ceil(file.size / this.config.chunkSize)

        const fileObj = {
            fileId: fileId,
            fileName: file.name,
            fileSize: file.size,
            fileType: file.type,
            fileHash: null,
            originFile: file,
            status: 'hashing',
            progress: 0,
            chunkIndex: 0,
            chunkTotal: chunkTotal,
        };

        if (!this.files.has(fileId)) {
            this.files.set(fileId, fileObj);
            this.emit('fileAdded', fileObj);
            this.processFile(fileObj);
        }
    }

    async processFile(fileObj) {

        try {

            fileObj.fileHash = await this.calculateFileMD5(fileObj.originFile);
            fileObj.status = 'ready';

            this.emit('hashCalculated', fileObj);

        } catch (error) {
            fileObj.status = 'error';
            this.emit('uploadError', fileObj, error);
        }
    }

    async scheduleFileUpload(fileObj) {
        if (this.concurrentFiles < this.config.concurrentFiles) {
            this.concurrentFiles++;
            await this.checkAndUploadFile(fileObj);
        }
    }

    async checkAndUploadFile(fileObj) {

        try {

            fileObj.status = 'checking';

            this.uploading = true
            this.emit('uploadStart', fileObj);

            const checkResult = await this.config.requestHandlers.checkFile({
                fileName: fileObj.fileName,
                fileHash: fileObj.fileHash,
                fileSize: fileObj.fileSize
            });

            if (checkResult.isExists) {

                fileObj.status = 'success';
                fileObj.progress = 100;

                this.concurrentFiles--;
                this.scheduleNextWaitingFile();
                this.uploadSuccessHandler(fileObj, checkResult);
            } else {

                fileObj.status = 'uploading';

                if (checkResult.chunkIndex) {
                    fileObj.chunkIndex = checkResult.chunkIndex + 1;
                }

                this.uploadChunk(fileObj);
            }

        } catch (error) {
            fileObj.status = 'error';

            this.concurrentFiles--;
            this.emit('uploadError', fileObj, error);
            this.scheduleNextWaitingFile();
        }
    }

    async uploadChunk(fileObj) {

        try {
            const startChunk = fileObj.chunkIndex * this.config.chunkSize;
            const endChunk = Math.min(startChunk + this.config.chunkSize, fileObj.fileSize);
            const fileChunk = fileObj.originFile.slice(startChunk, endChunk);

            const formData = new FormData();
            formData.append('fileChunk', fileChunk);
            formData.append('fileHash', fileObj.fileHash);
            formData.append('fileName', fileObj.fileName);
            formData.append('fileSize', fileObj.fileSize);
            formData.append('chunkIndex', fileObj.chunkIndex);
            formData.append('chunkTotal', fileObj.chunkTotal);

            const uploadResult = await this.config.requestHandlers.uploadFile(formData);

            fileObj.chunkIndex++;
            fileObj.progress = Math.round((fileObj.chunkIndex / fileObj.chunkTotal) * 100);

            this.emit('progress', fileObj);

            if (fileObj.chunkIndex === fileObj.chunkTotal) {

                fileObj.status = 'success';
                fileObj.progress = 100;

                this.concurrentFiles--;
                this.scheduleNextWaitingFile();
                this.uploadSuccessHandler(fileObj, uploadResult);

            } else {
                this.uploadChunk(fileObj);
            }

        } catch (error) {
            fileObj.status = 'error';

            this.concurrentFiles--;
            this.emit('uploadError', fileObj, error);
            this.scheduleNextWaitingFile();
        }
    }

    uploadSuccessHandler(fileObj, resultData) {
        this.emit('uploadSuccess', fileObj, resultData);

        if (this.concurrentFiles === 0) {
            this.uploading = false;
            this.emit('allCompleted');
        }
    }

    scheduleNextWaitingFile() {
        for (const fileObj of this.files.values()) {
            if (fileObj.status === 'ready') {
                this.scheduleFileUpload(fileObj);
                break;
            }
        }
    }

    calculateFileMD5(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            const spark = new SparkMD5.ArrayBuffer();
            const chunks = Math.ceil(file.size / this.config.chunkSize);

            let chunkIndex = 0;

            reader.onload = (e) => {
                spark.append(e.target.result);
                chunkIndex++;

                if (chunkIndex < chunks) {
                    const start = chunkIndex * this.config.chunkSize;
                    const slice = file.slice(start, Math.min(start + this.config.chunkSize, file.size));
                    reader.readAsArrayBuffer(slice);
                } else {
                    resolve(spark.end());
                }
            };

            reader.onerror = () => {
                reject(new Error('读取文件失败'));
            }

            reader.readAsArrayBuffer(file.slice(0, Math.min(this.config.chunkSize, file.size)));
        });
    }

    generateFileId(file) {
        return SparkMD5.hash(`hash-${file.name}-${file.size}-${file.lastModified}}`);
    }

    startUpload() {
        for (const fileObj of this.files.values()) {
            if (fileObj.status === 'ready') {
                this.scheduleFileUpload(fileObj);
            }
        }
    }

    on(event, handler) {
        if (this.eventHandlers[event]) {
            this.eventHandlers[event].add(handler);
        }
    }

    off(event, handler) {
        if (this.eventHandlers[event]) {
            this.eventHandlers[event].delete(handler);
        }
    }

    emit(event, ...data) {
        const handlers = this.eventHandlers[event];
        if (handlers) {
            handlers.forEach(handler => {
                try {
                    handler(...data);
                } catch (err) {
                    console.error(`${event} 事件处理器错误:`, err);
                }
            });
        }
    }
}