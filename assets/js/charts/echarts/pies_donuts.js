$(function () {

    /*** Set paths ****/
    require.config({
        paths: {
            echarts: 'assets/js/plugins/visualization/echarts'
        }
    });

    /**** Configuration ****/
    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/pie',
            'echarts/chart/funnel'
        ],

        /**** Charts setup ****/
        function (ec, limitless) {
            /**** Initialize charts ****/
            var basic_pie = ec.init(document.getElementById('basic_pie'), limitless);
            var basic_donut = ec.init(document.getElementById('basic_donut'), limitless);
            var multiple_donuts = ec.init(document.getElementById('multiple_donuts'), limitless);               

            /**** Basic pie options ****/
            basic_pie_options = {
                /**** Add title ****/
                title: {
                    text: 'Browser popularity',
                    subtext: 'Open source information',
                    x: 'center'
                },

                /**** Add tooltip ****/
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                /**** Add legend ****/
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: ['IE', 'Opera', 'Safari', 'Firefox', 'Chrome']
                },

                /**** Display toolbox ****/
                toolbox: {
                    show: true,
                    orient: 'vertical',
                    feature: {
                        mark: {
                            show: true,
                            title: {
                                mark: 'Markline switch',
                                markUndo: 'Undo markline',
                                markClear: 'Clear markline'
                            }
                        },
                        dataView: {
                            show: true,
                            readOnly: false,
                            title: 'View data',
                            lang: ['View chart data', 'Close', 'Update']
                        },
                        magicType: {
                            show: true,
                            title: {
                                pie: 'Switch to pies',
                                funnel: 'Switch to funnel',
                            },
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    y: '20%',
                                    width: '50%',
                                    height: '70%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
                        },
                        restore: {
                            show: true,
                            title: 'Restore'
                        },
                        saveAsImage: {
                            show: true,
                            title: 'Same as image',
                            lang: ['Save']
                        }
                    }
                },

                /**** Enable drag recalculate ****/
                calculable: true,

                /**** Add series ****/
                series: [{
                    name: 'Browsers',
                    type: 'pie',
                    radius: '70%',
                    center: ['50%', '57.5%'],
                    data: [
                        {value: 335, name: 'IE'},
                        {value: 310, name: 'Opera'},
                        {value: 234, name: 'Safari'},
                        {value: 135, name: 'Firefox'},
                        {value: 1548, name: 'Chrome'}
                    ]
                }]
            };

            /**** Basic donut options ****/
            basic_donut_options = {
                /**** Add title ****/
                title: {
                    text: 'Browser popularity',
                    subtext: 'Open source information',
                    x: 'center'
                },

                /**** Add legend ****/
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: ['Internet Explorer','Opera','Safari','Firefox','Chrome']
                },

                /**** Display toolbox ****/
                toolbox: {
                    show: true,
                    orient: 'vertical',
                    feature: {
                        mark: {
                            show: true,
                            title: {
                                mark: 'Markline switch',
                                markUndo: 'Undo markline',
                                markClear: 'Clear markline'
                            }
                        },
                        dataView: {
                            show: true,
                            readOnly: false,
                            title: 'View data',
                            lang: ['View chart data', 'Close', 'Update']
                        },
                        magicType: {
                            show: true,
                            title: {
                                pie: 'Switch to pies',
                                funnel: 'Switch to funnel',
                            },
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    y: '20%',
                                    width: '50%',
                                    height: '70%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
                        },
                        restore: {
                            show: true,
                            title: 'Restore'
                        },
                        saveAsImage: {
                            show: true,
                            title: 'Same as image',
                            lang: ['Save']
                        }
                    }
                },

                /**** Enable drag recalculate ****/
                calculable: true,

                /**** Add series ****/
                series: [
                    {
                        name: 'Browsers',
                        type: 'pie',
                        radius: ['50%', '70%'],
                        center: ['50%', '57.5%'],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true
                                },
                                labelLine: {
                                    show: true
                                }
                            },
                            emphasis: {
                                label: {
                                    show: true,
                                    formatter: '{b}' + '\n\n' + '{c} ({d}%)',
                                    position: 'center',
                                    textStyle: {
                                        fontSize: '17',
                                        fontWeight: '500'
                                    }
                                }
                            }
                        },
                        data: [
                            {value: 335, name: 'Internet Explorer'},
                            {value: 310, name: 'Opera'},
                            {value: 234, name: 'Safari'},
                            {value: 135, name: 'Firefox'},
                            {value: 1548, name: 'Chrome'}
                        ]
                    }
                ]
            };

            /**** Multiple donuts options ****/

            /**** Top text label ****/
            var labelTop = {
                normal: {
                    label: {
                        show: true,
                        position: 'center',
                        formatter: '{b}\n',
                        textStyle: {
                            baseline: 'middle',
                            fontWeight: 300,
                            fontSize: 15
                        }
                    },
                    labelLine: {
                        show: false
                    }
                }
            };

            /**** Format bottom label ****/
            var labelFromatter = {
                normal: {
                    label: {
                        formatter: function (params) {
                            return '\n\n' + (100 - params.value) + '%'
                        }
                    }
                }
            }

            /**** Bottom text label ****/
            var labelBottom = {
                normal: {
                    color: '#eee',
                    label: {
                        show: true,
                        position: 'center',
                        textStyle: {
                            baseline: 'middle'
                        }
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    color: 'rgba(0,0,0,0)'
                }
            };

            /**** Set inner and outer radius ****/
            var radius = [60, 75];

            /**** Add options ****/
            multiple_donuts_options = {
                /**** Add title ****/
                title: {
                    text: 'The Application World',
                    subtext: 'from global web index',
                    x: 'center'
                },
                /**** Add legend ****/
                legend: {
                    x: 'center',
                    y: '56%',
                    data: ['GoogleMaps', 'Facebook', 'Youtube', 'Google+', 'Weixin', 'Twitter', 'Skype', 'Messenger', 'Whatsapp', 'Instagram']
                },
                /**** Add series ****/
                series: [
                    {
                        type: 'pie',
                        center: ['10%', '32.5%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 46, itemStyle: labelBottom},
                            {name: 'GoogleMaps', value: 54,itemStyle: labelTop}
                        ]
                    },
                    {
                        type: 'pie',
                        center: ['30%', '32.5%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 56, itemStyle: labelBottom},
                            {name: 'Facebook', value: 44,itemStyle: labelTop}
                        ]
                    },
                    {
                        type: 'pie',
                        center: ['50%', '32.5%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 65, itemStyle: labelBottom},
                            {name: 'Youtube', value: 35,itemStyle: labelTop}
                        ]
                    },
                    {
                        type: 'pie',
                        center: ['70%', '32.5%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 70, itemStyle: labelBottom},
                            {name: 'Google+', value: 30,itemStyle: labelTop}
                        ]
                    },
                    {
                        type: 'pie',
                        center: ['90%', '32.5%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name:'other', value:73, itemStyle: labelBottom},
                            {name:'Weixin', value:27,itemStyle: labelTop}
                        ]
                    },
                    {
                        type: 'pie',
                        center: ['10%', '82.5%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 78, itemStyle: labelBottom},
                            {name: 'Twitter', value: 22,itemStyle: labelTop}
                        ]
                    },
                    {
                        type: 'pie',
                        center: ['30%', '82.5%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 78, itemStyle: labelBottom},
                            {name: 'Skype', value: 22,itemStyle: labelTop}
                        ]
                    },
                    {
                        type: 'pie',
                        center: ['50%', '82.5%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 78, itemStyle: labelBottom},
                            {name: 'Messenger', value: 22,itemStyle: labelTop}
                        ]
                    },
                    {
                        type: 'pie',
                        center: ['70%', '82.5%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'other', value: 83, itemStyle: labelBottom},
                            {name: 'Whatsapp', value: 17,itemStyle: labelTop}
                        ]
                    },
                    {
                        type: 'pie',
                        center: ['90%', '82.5%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name:'other', value:89, itemStyle: labelBottom},
                            {name:'Instagram', value:11,itemStyle: labelTop}
                        ]
                    }
                ]
            };

            /**** Apply options ****/
            basic_pie.setOption(basic_pie_options);
            basic_donut.setOption(basic_donut_options);
            multiple_donuts.setOption(multiple_donuts_options);

            /**** Resize charts ****/
            window.onresize = function () {
                setTimeout(function (){
                    basic_pie.resize();
                    basic_donut.resize();
                    multiple_donuts.resize();
                }, 200);
            }
        }
    );
});
