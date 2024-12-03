layui.define(['easyHelper', 'jquery'], function (exports) {

    const easyHelper = layui.easyHelper;

    const easyMap = {};

    easyMap.autoSearch = (options) => {

        const defaultOptions = {
            map: null,
            setting: {
                pageSize: 10,
                region: '上饶',
                regionFix: true,
            }
        };

        options = Object.assign(defaultOptions, options);

        const container = $(options.map.getContainer());
        const suggestion = new TMap.service.Suggestion(options.setting);

        container.append(`<div class="map-search">
                            <div class="map-search-container">
                                <input class="map-search-input" type="text" placeholder="请输入关键词">
                                <button class="map-search-button" type="button">搜索</button>
                            </div>
                            <ul class="map-search-result"></ul>
                        </div>`);

        let suggestList = [];

        const getSuggestions = easyHelper.throttle((keywords) => {
            suggestion.getSuggestions({
                keyword: keywords,
                location: options.map.getCenter()
            }).then((result) => {

                suggestList = result.data;

                let searchResult = '';
                if (result.data.length > 0) {
                    result.data.forEach((item, key) => {
                        searchResult += `<li class="map-search-item" data-index="${key}">
                                            <h3>${item.title}</h3>
                                            <p>${item.address}</p>
                                        </li>`;
                    })
                } else {
                    searchResult = '<li class="map-search-empty">未查询到相关位置</li>';
                }
                container.find(".map-search-result").html(searchResult);
            });
        }, 300);

        const searchSuggestions = () => {
            const keywords = container.find(".map-search-input").val();
            if (keywords) {
                getSuggestions(keywords);
            } else {
                container.find(".map-search-result").empty();
            }
        }

        container.find(".map-search-input").on('input', () => {
            searchSuggestions();
        });

        container.find(".map-search-button").click(() => {
            searchSuggestions();
        });

        container.find(".map-search-result").on("click", ".map-search-item", function () {

            container.find(".map-search-result").empty();

            const index = $(this).data('index');
            const suggest = suggestList[index];

            options.map.setCenter(suggest.location);
        });

        return suggestion;
    }

    /**
     * 自动范围圈
     */
    easyMap.autoCircle = (options) => {

        const defaultOptions = {
            map: null,
            radius: 500
        }

        options = Object.assign(defaultOptions, options);

        const autoCircle = new TMap.MultiCircle({
            map: options.map,
            geometries: [{
                id: 'autoCircle',
                center: options.map.getCenter(),
                radius: options.radius
            }]
        });

        options.map.on("pan", () => {
            autoCircle.updateGeometries({
                id: "autoCircle",
                center: options.map.getCenter(),
                radius: options.radius
            });
        });

        return autoCircle;
    }

    /**
     * 自动标记点
     */
    easyMap.autoMarker = (options) => {

        const defaultOptions = {
            map: null
        }

        options = Object.assign(defaultOptions, options);

        const markerStyle = new TMap.MarkerStyle({
            width: 26,
            height: 38,
            anchor: {
                x: 13,
                y: 38
            }
        });

        const autoMarker = new TMap.MultiMarker({
            map: options.map,
            styles: {
                autoMarker: markerStyle
            },
            geometries: [{
                id: 'autoMarker',
                styleId: 'autoMarker',
                position: options.map.getCenter()
            }]
        });

        options.map.on("pan", () => {
            autoMarker.updateGeometries({
                id: 'autoMarker',
                styleId: 'autoMarker',
                position: options.map.getCenter()
            });
        });

        return autoMarker;
    }

    /**
     * IP定位
     */
    easyMap.autoLocation = (options) => {

        const IPLocation = new TMap.service.IPLocation()

        IPLocation.locate().then((response) => {
            options.map.setCenter(response.result.location);
        });

        return IPLocation;
    }

    /**
     * 自动获取地址
     */
    easyMap.autoAddress = (options) => {

        const geocoder = new TMap.service.Geocoder();

        const defaultOptions = {
            map: null
        }

        options = Object.assign(defaultOptions, options);

        const getAddress = easyHelper.throttle((location) => {
            geocoder.getAddress({
                location: location
            }).then((response) => {
                options.change({
                    result: response.result,
                    address: response.result.formatted_addresses ? response.result.formatted_addresses.recommend : response.result.address,
                    location: response.result.location,
                });
            });
        }, 500);

        options.map.on('pan', () => {
            getAddress(options.map.getCenter());
        });

        return geocoder;
    }

    exports("easyMap", easyMap);
});