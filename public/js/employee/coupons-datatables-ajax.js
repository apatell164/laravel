var gridRows = 0;   //-- Main Tab
var grid = '';
var TableDatatablesAjax = function () {
    var handleRecords = function () {
        var action = $('#category').val();
        grid = new Datatable();
        grid.setAjaxParam("catValue", action);
        if (active != '') {
            grid.setAjaxParam("activeValue", active);
        }
        grid.init({
            src: $("#datatable_ajax"),
            onSuccess: function (grid, response) {
                gridRows = response.recordsTotal;

                if (response.recordsTotal < 1) {
                    $('.deleteMass').hide();
                    $("#menu1.tab-pane .notabreocrd").show();
                    $("#menu1.tab-pane .withrecords").hide();
                } else {
                    $('.deleteMass').show();
                    $("#menu1.tab-pane .notabreocrd").hide();
                    $("#menu1.tab-pane .withrecords").show();
                }

                if (response.recordsTotal < 1) { $('.ExportRecord').hide(); } else { $('.ExportRecord').show(); }
                totalRec = response.recordsTotal;

                if (response.recordsTotal < 20) {
                    $('.gridjs-pages') .closest(".datatable_ajax_wrapper" ).hide();
                } else {
                    $('.gridjs-pages') .closest(".datatable_ajax_wrapper" ).show();
                }

                if (response.newRecordCount > 0) {
                    $('.newcounter').text(response.newRecordCount).show();
                } else {
                    $('.newcounter').hide();
                }
                setTimeout(function () {
                    $.each(settingarray, function (index, value) {
                        if (index == 'P') {
                            $.each(value, function (index, columnid) {
                                $('#datatable_ajax thead').find('.' + columnid).addClass("hidecolumn");
                                $("#datatable_ajax tbody").find('tr').each(function (index, value) {
                                    $(this).find('.' + columnid).addClass("hidecolumn");
                                });
                            });
                        }
                    });
                }, 1200);
            },
            onError: function (grid) {
                // execute some code on network or other general error
            },
            onDataLoad: function (grid) {
                $(document).ready(function () {
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl)
                    })
                });
                // execute some code on ajax data load
                // $('.make-switch').bootstrapSwitch();
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "dom": "t <'gridjs-footer' <'gridjs-pagination'i <'gridjs-pages'p>>>",
                "deferRender": true,
                // "stateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                // "lengthMenu": [
                //     [10, 20, 50, 100],
                //     [10, 20, 50, 100] // change per page values here
                // ],
                "pageLength": 20, // default record count per page

                // Code for sorting
                "serverSide": true,
                "lengthChange": false,
                "pagingType": "simple_numbers",
                "language": {
                    "info": '<div role="status" aria-live="polite" class="gridjs-summary">Showing <b>_START_</b> to <b>_END_</b> of <b>_TOTAL_</b> results</div>', // title="Page 1 of 2"
                },
                "columns": [{
                        "data": 0,
                        'class': ' text-center',
                        'bSortable': false
                    },  {
                        "data": 1,
                        'class': 'text-left Pages_title_P_1 mob-show_div',
                        'name': 'varTags'
                    },{
                        "data": 2,
                        'class': 'text-left Pages_title_P_1 mob-show_div',
                        'name': 'varTitle'
                    },{
                        "data": 3,
                        'class': 'text-left Pages_title_P_1 mob-show_div',
                        'name': 'varTitle',
                        'bSortable': false,
                    }, {
                        "data": 4,
                        'class': 'text-center Pages_image_P_3',
                        'bSortable': false
                    },
                    {
                        "data": 5,
                        'class': 'text-center Pages_image_P_3',
                        'bSortable': false
                    },
                    {
                        "data": 6,
                        'class': 'text-center Pages_order_P_4',
                        'bSortable': false
                    },
                    {
                        "data": 7,
                        'class': 'text-center Pages_order_P_4',
                        'bSortable': false
                    },
                    {
                        "data": 8,
                        'class': 'text-center Pages_order_P_4',
                        "name": 'dtDateTime',
                    },
                    {
                        "data": 9,
                        'class': 'text-center Pages_order_P_4',
                        'bSortable': false
                    },
                    {
                        "data": 10,
                        'class': 'text-center Pages_order_P_4',
                        'bSortable': false
                    },
                    {
                        "data": 11,
                        className: 'text-center form-switch Pages_publish_P_5',
                        'bSortable': false
                    },
                    {
                        "data": 12,
                        "bSortable": false,
                        className: 'text-center Pages_dactions_P_4 last_td_action mob-show_div'
                    }
                ],
                "ajax": {
                    "url": window.site_url + "/powerpanel/coupons/get_list", // ajax source
                },
                'fnCreatedRow': function (nRow, aData, iDataIndex) {
                    //$(nRow).attr('data-order', aData[10]);
                },
                "order": [
                    [8, "desc"]
                ]
            }
        });

        $('#datatable_ajax tbody').on('click', '.moveDwn', function () {
            var order = $(this).data('order');
            exOrder = order + 1;
            reorder(order, exOrder);
        });
        $('#datatable_ajax tbody').on('click', '.moveUp', function () {
            var order = $(this).data('order');
            exOrder = order - 1;
            reorder(order, exOrder);
        });

        generateHeadfilterEvents(grid);

        $(document).on('keyup', '#searchfilter', function (e) {
            e.preventDefault();
            var action = $('#searchfilter').val();
            if (action.length >= 2) {
                // $.cookie('CouponsSearch', action);
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("searchValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                // $.removeCookie('CouponsSearch');
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("searchValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            }
        });


        $(document).on('change', '#contactleadrange', function(e) {
            e.preventDefault();
            var action = {};
            action['from'] = $('#start_date').val();
            action['to'] = $('#end_date').val();
            if (action['from'] != '' && action['to'] != '') {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("rangeFilter", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else if (action['from'] != '' && action['to'] == '') {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("rangeFilter", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("rangeFilter", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
            }
        });

        

        $(document).on('change', '#statusfilter', function (e) {
            e.preventDefault();
            var action = $('#statusfilter').val();
            if (action != "") {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("statusValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("statusValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
            }
        });

        $(document).on('change', '#categoriesfilter', function (e) {
            e.preventDefault();
            var action = $('#categoriesfilter').val(); 
            if (action != "") {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("parentcatValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("parentcatValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            }
        });

        $(document).on('change', '#businessfilter', function (e) {
            e.preventDefault();
            var action = $('#businessfilter').val(); 
            if (action != "") {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("bnameValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("bnameValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            }
        });

        $(document).on('change', '#typefilter', function (e) {
            e.preventDefault();
            var action = $('#typefilter').val(); 
            if (action != "") {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("ctypeValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("ctypeValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            }
        });

        $(document).on('change', '#category', function (e) {
            e.preventDefault();
            var action = $('#category').val();

            if (action != "") {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("catValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("catValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
            }
        });

        $(document).on("change", ".publish", function (event, state) {
            //e.preventDefault();
            var controller = $(this).data('controller');
            var alias = $(this).data('alias');
            var val = $(this).data('value');
            var url = site_url + '/' + controller + '/publish';
            $.ajax({
                url: url,
                data: {
                    alias: alias,
                    val: val
                },
                type: "POST",
                dataType: "HTML",
                success: function (data) {
                    grid.getDataTable().ajax.reload(null, false);
                },
                error: function () {
                    console.log('error!');
                }
            });
        });

        $('.ExportRecord').on('click', function(e) { 
            e.preventDefault();
            // if (totalRec < 1) {
            //     $('#noRecords').modal('show');
            // } else {
            //     $('#noRecords').modal('hide');
                // var exportRadioVal = 'all_records';
                // if (exportRadioVal != '') {
                //     if (exportRadioVal == 'selected_records') {
                //         if ($('#ExportRecord').click) {
                //         	console.log($('input[name="delete[]"]:checked').val());
                //             if ($('input[name="delete[]"]:checked').val()) {
                //                 ip = '?' + $('input[name="delete[]"]:checked').serialize() + '&' + 'export_type' + '=' + exportRadioVal;
                //                 var ajaxurl = window.site_url + "/powerpanel/coupons/ExportRecord" + ip;
                //                 window.location = ajaxurl;
                //                 grid.getDataTable().ajax.reload();
                //             } else {
                //                 $('#noSelectedRecords').modal('show');
                //             }
                //         }
                //     } else {
                        // $('#selected_records').modal('hide');

                        var action = {};
                        action['from'] = $('#start_date').val();
                        action['to'] = $('#end_date').val();
           
                    //    alert(action);
                       var search = $('#searchfilter').val();

                      

                        ip = '?'+'searchValue'+'='+search +'&'+'to'+'='+action['to']+'&'+'from'+'='+action['from'];
                        e.preventDefault();
                        // var ajaxurl = window.site_url+"/powerpanel/contact-us/ExportRecord"+ip;

                        var ajaxurl = window.site_url + "/powerpanel/coupons/ExportRecord"+ip;
                        window.location = ajaxurl;
                //     }
                // }
            // }
        });

        $('a[data-toggle="tab"][id="MenuItem1"]').on('shown.bs.tab', function (e) {
            $("#hidefilter").show();
            e.preventDefault();
            grid.setAjaxParam("id", grid.getSelectedRows());
            grid.getDataTable().ajax.reload();
        });

        // if (!showChecker) {
        //     if (grid != "") {
        //         grid.getDataTable().column(8).visible(false);
        //     } else {
        //         grid.getDataTable().column(8).visible(true);
        //     }
        // }

        grid.setAjaxParam("customActionType", "group_action");
        grid.clearAjaxParams();
        grid.getDataTable().columns().iterator('column', function (ctx, idx) {
            $(grid.getDataTable().column(idx).header()).append('<span class="sort-icon"/>');
        });
    }
    return {
        //main function to initiate the module
        init: function () {
            $.fn.DataTable.ext.pager.numbers_length = 4;
            handleRecords();
        }
    };
}();

// var grid1Rows = 0; //-- Approval Tab
// var grid1 = '';
// var TableDatatablesAjax1 = function () {
//     var handleRecords1 = function () {
//         grid1 = new Datatable();
//         grid1.init({
//             src: $("#datatable_ajax_approved"),
//             onSuccess: function (grid1, response) {
//                 gridRows1 = response.recordsTotal;
//                 if (response.recordsTotal < 1) {
//                     $('.deleteMass').hide();
//                     $("#menu2.tab-pane .notabreocrd").show();
//                     $("#menu2.tab-pane .withrecords").hide();
//                 } else {
//                     $('.deleteMass').show();
//                     $("#menu2.tab-pane .notabreocrd").hide();
//                     $("#menu2.tab-pane .withrecords").show();
//                 }

//                 if (response.recordsTotal < 20) {
//                     $('.gridjs-pages').hide();
//                 } else {
//                     $('.gridjs-pages').show();
//                 }

//                 if (response.newRecordCount > 0) {
//                     $('.newcounter').text(response.newRecordCount).show();
//                 } else {
//                     $('.newcounter').hide();
//                 }
//                 setTimeout(function () {
//                     $.each(settingarray, function (index, value) {
//                         if (index == 'A') {
//                             $.each(value, function (index, columnid) {
//                                 $('#datatable_ajax_approved thead').find('.' + columnid).addClass("hidecolumn");
//                                 $("#datatable_ajax_approved tbody").find('tr').each(function (index, value) {
//                                     $(this).find('.' + columnid).addClass("hidecolumn");
//                                 });
//                             });
//                         }
//                     });
//                 }, 1500);

//             },
//             onError: function (grid1) {
//                 // execute some code on network or other general error
//             },
//             onDataLoad: function (grid1) {
//                 $(document).ready(function () {
//                     var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
//                     var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
//                         return new bootstrap.Tooltip(tooltipTriggerEl)
//                     })
//                 });
//                 // execute some code on ajax data load
//                 // $('.make-switch').bootstrapSwitch();
//             },
//             loadingMessage: 'Loading...',
//             dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options
//                 // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
//                 // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
//                 // So when dropdowns used the scrollable div should be removed.
//                 //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
//                 "dom": "t <'gridjs-footer' <'gridjs-pagination'i <'gridjs-pages'p>>>",
//                 "deferRender": true,
//                 // "stateSave": true, // save datatable state(pagination, sort, etc) in cookie.
//                 // "lengthMenu": [
//                 //     [10, 20, 50, 100],
//                 //     [10, 20, 50, 100] // change per page values here
//                 // ],
//                 "pageLength": 20, // default record count per page
//                 // Code for sorting 
//                 "serverSide": true,
//                 "lengthChange": false,
//                 "pagingType": "simple_numbers",
//                 "language": {
//                     "info": '<div role="status" aria-live="polite" class="gridjs-summary">Showing <b>_START_</b> to <b>_END_</b> of <b>_TOTAL_</b> results</div>', // title="Page 1 of 2"
//                 },
//                 "columns": [{
//                         "data": 0,
//                         'class': ' text-center',
//                         'bSortable': false
//                     }, {
//                         "data": 1,
//                         'class': 'text-left Pages_title_P_1 mob-show_div',
//                         'name': 'varTitle'
//                     }, {
//                         "data": 2,
//                         'class': 'text-left Pages_sdate_P_2',
//                         "name": 'dtDateTime'
//                     },
// //                    {
// //                        "data": 3,
// //                        'class': 'text-center form-switch Pages_publish_P_3',
// //                        'bSortable': false
// //                    }, 
//                     {
//                         "data": 3,
//                         'class': 'text-center Pages_dactions_P_4 last_td_action mob-show_div',
//                         'bSortable': false
//                     }],
//                 "ajax": {
//                     "url": window.site_url + "/powerpanel/coupons/get_list_New", // ajax source
//                 },
//                 'fnCreatedRow': function (nRow, aData, iDataIndex) {
//                 },
//                 "order": [
//                     [2, "desc"]
//                 ]
//             }
//         });

//         $('#datatable_ajax_approved tbody').on('click', '.moveDwn', function () {
//             var order = $(this).data('order');
//             exOrder = order + 1;
//             reorder(order, exOrder);
//         });
//         $('#datatable_ajax_approved tbody').on('click', '.moveUp', function () {
//             var order = $(this).data('order');
//             exOrder = order - 1;
//             reorder(order, exOrder);
//         });

//         generateHeadfilterEvents(grid1);
//         $(document).on('keyup', '#searchfilter', function (e) {
//             e.preventDefault();
//             var action = $('#searchfilter').val();
//             if (action.length >= 2) {
//                 $.cookie('CouponsSearch', action);
//                 grid1.setAjaxParam("customActionType", "group_action");
//                 grid1.setAjaxParam("searchValue", action);
//                 grid1.setAjaxParam("id", grid1.getSelectedRows());
//                 grid1.getDataTable().ajax.reload();
//             } else {
//                 $.removeCookie('CouponsSearch');
//                 grid1.setAjaxParam("customActionType", "group_action");
//                 grid1.setAjaxParam("searchValue", action);
//                 grid1.setAjaxParam("id", grid1.getSelectedRows());
//                 grid1.getDataTable().ajax.reload();
//             }
//         });

//         $(document).on('change', '#statusfilter', function (e) {

//             e.preventDefault();
//             var action = $('#statusfilter').val();
//             if (action != "") {
//                 grid1.setAjaxParam("customActionType", "group_action");
//                 grid1.setAjaxParam("statusValue", action);
//                 grid1.setAjaxParam("id", grid1.getSelectedRows());
//                 grid1.getDataTable().ajax.reload();
//             } else {
//                 grid1.setAjaxParam("customActionType", "group_action");
//                 grid1.setAjaxParam("statusValue", action);
//                 grid1.setAjaxParam("id", grid1.getSelectedRows());
//             }
//         });

//         $(document).on("change", ".publish", function (event, state) {
//             //e.preventDefault();
//             var controller = $(this).data('controller');
//             var alias = $(this).data('alias');
//             var val = $(this).data('value');
//             var url = site_url + '/' + controller + '/publish';
//             $.ajax({
//                 url: url,
//                 data: {
//                     alias: alias,
//                     val: val
//                 },
//                 type: "POST",
//                 dataType: "HTML",
//                 success: function (data) {
//                     grid1.getDataTable().ajax.reload(null, false);
//                 },
//                 error: function () {
//                     console.log('error!');
//                 }
//             });
//         });

//         $('a[data-toggle="tab"][id="MenuItem2"]').on('shown.bs.tab', function (e) {
//             $("#hidefilter").show();
//             e.preventDefault();
//             grid1.setAjaxParam("id", grid1.getSelectedRows());
//             grid1.getDataTable().ajax.reload();
//         });

//         grid1.setAjaxParam("customActionType", "group_action");
//         grid1.clearAjaxParams();
//         grid1.getDataTable().columns().iterator('column', function (ctx, idx) {
//             $(grid1.getDataTable().column(idx).header()).append('<span class="sort-icon"/>');
//         });
//     }
//     return {
//         //main function to initiate the module
//         init: function () {
//             $.fn.DataTable.ext.pager.numbers_length = 4;
//             handleRecords1();
//         }
//     };
// }();


// var gridRows2 = 0;  //-- Draft Tab
// var grid2 = '';
// var TableDatatablesAjax2 = function () {
//     var handleRecords2 = function () {
//         var action = $('#category').val();
//         grid2 = new Datatable();
//         grid2.setAjaxParam("catValue", action);
//         grid2.init({
//             src: $("#datatable_ajax2"),
//             onSuccess: function (grid2, response) {
//                 gridRows2 = response.recordsTotal;
//                 if (response.recordsTotal < 1) {
//                     $('.deleteMass').hide();
//                     $("#menu3.tab-pane .notabreocrd").show();
//                     $("#menu3.tab-pane .withrecords").hide();
//                 } else {
//                     $('.deleteMass').show();
//                     $("#menu3.tab-pane .notabreocrd").hide();
//                     $("#menu3.tab-pane .withrecords").show();
//                 }

//                 if (response.recordsTotal < 20) {
//                     $('.gridjs-pages').hide();
//                 } else {
//                     $('.gridjs-pages').show();
//                 }

//                 if (response.newRecordCount > 0) {
//                     $('.newcounter').text(response.newRecordCount).show();
//                 } else {
//                     $('.newcounter').hide();
//                 }
//                 setTimeout(function () {
//                     $.each(settingarray, function (index, value) {
//                         if (index == 'D') {
//                             $.each(value, function (index, columnid) {
//                                 $('#datatable_ajax2 thead').find('.' + columnid).addClass("hidecolumn");
//                                 $("#datatable_ajax2 tbody").find('tr').each(function (index, value) {
//                                     $(this).find('.' + columnid).addClass("hidecolumn");
//                                 });
//                             });
//                         }
//                     });
//                 }, 1500);
//             },
//             onError: function (grid2) {
//                 // execute some code on network or other general error
//             },
//             onDataLoad: function (grid2) {
//                 $(document).ready(function () {
//                     var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
//                     var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
//                         return new bootstrap.Tooltip(tooltipTriggerEl)
//                     })
//                 });
//                 // execute some code on ajax data load
//                 // $('.make-switch').bootstrapSwitch();
//             },
//             loadingMessage: 'Loading...',
//             dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options
//                 // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
//                 // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
//                 // So when dropdowns used the scrollable div should be removed.
//                 //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
//                 "dom": "t <'gridjs-footer' <'gridjs-pagination'i <'gridjs-pages'p>>>",
//                 "deferRender": true,
//                 // "stateSave": true, // save datatable state(pagination, sort, etc) in cookie.
//                 // "lengthMenu": [
//                 //     [10, 20, 50, 100],
//                 //     [10, 20, 50, 100] // change per page values here
//                 // ],
//                 "pageLength": 20, // default record count per page
//                 // Code for sorting 
//                 "serverSide": true,
//                 "lengthChange": false,
//                 "pagingType": "simple_numbers",
//                 "language": {
//                     "info": '<div role="status" aria-live="polite" class="gridjs-summary">Showing <b>_START_</b> to <b>_END_</b> of <b>_TOTAL_</b> results</div>', // title="Page 1 of 2"
//                 },
//                 "columns": [{
//                         "data": 0,
//                         'class': ' text-center',
//                         'bSortable': false
//                     }, {
//                         "data": 1,
//                         'class': 'text-left Pages_title_P_1 mob-show_div',
//                         'name': 'varTitle'
//                     },
// //                    {
// //                        "data": 2,
// //                        'class': 'text-center Pages_sdate_P_2',
// //                        'bSortable': false
// //                    },
//                     {
//                         "data": 2,
//                         'class': 'text-center Pages_sdate_P_2',
//                         'bSortable': false
//                     },
// //                    {
// //                        "data": 3,
// //                        'class': 'text-center form-switch Pages_publish_P_3',
// //                        'bSortable': false
// //                    },
//                     {
//                         "data": 3,
//                         'class': 'text-center Pages_dactions_P_4 last_td_action mob-show_div',
//                         'bSortable': false
//                     }],
//                 "ajax": {
//                     "url": window.site_url + "/powerpanel/coupons/get_list_draft", // ajax source
//                 },
//                 'fnCreatedRow': function (nRow, aData, iDataIndex) {
//                     //$(nRow).attr('data-order', aData[10]);
//                 },
//                 "order": [
//                     [1, "desc"]
//                 ]
//             }
//         });

//         $('#datatable_ajax2 tbody').on('click', '.moveDwn', function () {
//             var order = $(this).data('order');
//             exOrder = order + 1;
//             reorder(order, exOrder);
//         });
//         $('#datatable_ajax2 tbody').on('click', '.moveUp', function () {
//             var order = $(this).data('order');
//             exOrder = order - 1;
//             reorder(order, exOrder);
//         });

//         generateHeadfilterEvents(grid2);
//         $(document).on('keyup', '#searchfilter', function (e) {
//             e.preventDefault();
//             var action = $('#searchfilter').val();
//             if (action.length >= 2) {
//                 // $.cookie('CouponsSearch', action);
//                 grid2.setAjaxParam("customActionType", "group_action");
//                 grid2.setAjaxParam("searchValue", action);
//                 grid2.setAjaxParam("id", grid2.getSelectedRows());
//                 grid2.getDataTable().ajax.reload();
//             } else {
//                 // $.removeCookie('CouponsSearch');
//                 grid2.setAjaxParam("customActionType", "group_action");
//                 grid2.setAjaxParam("searchValue", action);
//                 grid2.setAjaxParam("id", grid2.getSelectedRows());
//                 grid2.getDataTable().ajax.reload();
//             }
//         });

//         $(document).on('change', '#statusfilter', function (e) {

//             e.preventDefault();
//             var action = $('#statusfilter').val();
//             if (action != "") {
//                 grid2.setAjaxParam("customActionType", "group_action");
//                 grid2.setAjaxParam("statusValue", action);
//                 grid2.setAjaxParam("id", grid2.getSelectedRows());
//                 grid2.getDataTable().ajax.reload();
//             } else {
//                 grid2.setAjaxParam("customActionType", "group_action");
//                 grid2.setAjaxParam("statusValue", action);
//                 grid2.setAjaxParam("id", grid2.getSelectedRows());
//             }
//         });

//         $(document).on('change', '#category', function (e) {
//             e.preventDefault();
//             var action = $('#category').val();

//             if (action != "") {
//                 grid2.setAjaxParam("customActionType", "group_action");
//                 grid2.setAjaxParam("catValue", action);
//                 grid2.setAjaxParam("id", grid2.getSelectedRows());
//                 grid2.getDataTable().ajax.reload();
//             } else {
//                 grid2.setAjaxParam("customActionType", "group_action");
//                 grid2.setAjaxParam("catValue", action);
//                 grid2.setAjaxParam("id", grid2.getSelectedRows());
//             }
//         });

//         $(document).on("change", ".publish", function (event, state) {
//             //e.preventDefault();
//             var controller = $(this).data('controller');
//             var alias = $(this).data('alias');
//             var val = $(this).data('value');
//             var url = site_url + '/' + controller + '/publish';
//             $.ajax({
//                 url: url,
//                 data: {
//                     alias: alias,
//                     val: val
//                 },
//                 type: "POST",
//                 dataType: "HTML",
//                 success: function (data) {
//                     grid2.getDataTable().ajax.reload(null, false);
//                 },
//                 error: function () {
//                     console.log('error!');
//                 }
//             });
//         });

//         $('a[data-toggle="tab"][id="MenuItem3"]').on('shown.bs.tab', function (e) {
//             $("#hidefilter").hide();
//             e.preventDefault();
//             grid2.setAjaxParam("id", grid2.getSelectedRows());
//             grid2.getDataTable().ajax.reload();
//         });


//         grid2.setAjaxParam("customActionType", "group_action");
//         grid2.clearAjaxParams();
//         grid2.getDataTable().columns().iterator('column', function (ctx, idx) {
//             $(grid2.getDataTable().column(idx).header()).append('<span class="sort-icon"/>');
//         });
//     }
//     return {
//         //main function to initiate the module
//         init: function () {
//             $.fn.DataTable.ext.pager.numbers_length = 4;
//             handleRecords2();
//         }
//     };
// }();


var gridRows3 = 0;  //-- Trash Tab
var grid3 = '';
var TableDatatablesAjax3 = function () {
    var handleRecords3 = function () {
        var action = $('#category').val();
        grid3 = new Datatable();
        grid3.setAjaxParam("catValue", action);
        grid3.init({
            src: $("#datatable_ajax3"),
            onSuccess: function (grid3, response) {
                gridRows3 = response.recordsTotal;
                if (response.recordsTotal < 1) {
                    $('.deleteMass').hide();
                    $("#menu4.tab-pane .notabreocrd").show();
                    $("#menu4.tab-pane .withrecords").hide();
                } else {
                    $('.deleteMass').show();
                    $("#menu4.tab-pane .notabreocrd").hide();
                    $("#menu4.tab-pane .withrecords").show();
                }

                if (response.recordsTotal < 20) {
                    $('.gridjs-pages').hide();
                } else {
                    $('.gridjs-pages').show();
                }

                if (response.newRecordCount > 0) {
                    $('.newcounter').text(response.newRecordCount).show();
                } else {
                    $('.newcounter').hide();
                }

                setTimeout(function () {
                    $.each(settingarray, function (index, value) {
                        if (index == 'T') {
                            $.each(value, function (index, columnid) {
                                $('#datatable_ajax3 thead').find('.' + columnid).addClass("hidecolumn");
                                $("#datatable_ajax3 tbody").find('tr').each(function (index, value) {
                                    $(this).find('.' + columnid).addClass("hidecolumn");
                                });
                            });
                        }
                    });
                }, 1500);
            },
            onError: function (grid3) {
                // execute some code on network or other general error
            },
            onDataLoad: function (grid3) {
                $(document).ready(function () {
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl)
                    })
                });
                // execute some code on ajax data load
                // $('.make-switch').bootstrapSwitch();
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "dom": "t <'gridjs-footer' <'gridjs-pagination'i <'gridjs-pages'p>>>",
                "deferRender": true,
                // "stateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                // "lengthMenu": [
                //     [10, 20, 50, 100],
                //     [10, 20, 50, 100] // change per page values here
                // ],
                "pageLength": 20, // default record count per page
                // Code for sorting 
                "serverSide": true,
                "lengthChange": false,
                "pagingType": "simple_numbers",
                "language": {
                    "info": '<div role="status" aria-live="polite" class="gridjs-summary">Showing <b>_START_</b> to <b>_END_</b> of <b>_TOTAL_</b> results</div>', // title="Page 1 of 2"
                },
                "columns": [{
                        "data": 0,
                        'class': ' text-center',
                        'bSortable': false
                    },
                    {
                        "data": 1,
                        'class': 'text-left Pages_title_P_1 mob-show_div',
                        'name': 'varTags'
                    },
                    {
                        "data": 2,
                        'class': 'text-left Pages_title_P_1 mob-show_div',
                        'name': 'varTitle'
                    },
                    {
                        "data": 3,
                        'class': 'text-left Pages_title_P_1 mob-show_div',
                        'name': 'varTitle'
                    },
                    {
                        "data": 4,
                        'class': 'text-center Pages_image_P_3',
                        'bSortable': false
                    }, {
                        "data": 5,
                        'class': 'text-center Pages_image_P_3',
                        'bSortable': false
                    },
                    {
                        "data": 6,
                        'class': 'text-center Pages_image_P_3',
                        'bSortable': false
                    },
                   {
                       "data": 7,
                       'class': 'text-center Pages_image_P_3',
                       'bSortable': false
                   },
                   {
                        "data": 8,
                        'class': 'text-center Pages_order_P_4',
                        'bSortable': true,
                        'name': 'dtDateTime'
                    },
                    {
                        "data": 9,
                        'class': 'text-center Pages_order_P_4',
                        'bSortable': false
                    },
                    {
                        "data": 10,
                        'class': 'text-center Pages_order_P_4',
                        'bSortable': false
                    },
                    {
                        "data": 11,
                        'class': 'text-center Pages_dactions_P_4 last_td_action mob-show_div',
                        'bSortable': false
                    },
                    // {
                    //     "data": 9,
                    //     "name": 'dtDateTime',
                    //     "bSortable": false,
                    //     className: 'text-center Coupon_sdate_P_5'
                    // }, 
                    
                ],
                "ajax": {
                    "url": window.site_url + "/powerpanel/coupons/get_list_trash", // ajax source
                },
                'fnCreatedRow': function (nRow, aData, iDataIndex) {
                    //$(nRow).attr('data-order', aData[10]);
                },
                // "columnDefs": [
                //     {
                //       "targets": [ 9 ],
                //       "visible": false,
                //       "searchable": false               
                //     }
                //  ],
                "order": [
                    [8, "desc"]
                ]
            }
        });

        $('#datatable_ajax3 tbody').on('click', '.moveDwn', function () {
            var order = $(this).data('order');
            exOrder = order + 1;
            reorder(order, exOrder);
        });
        $('#datatable_ajax3 tbody').on('click', '.moveUp', function () {
            var order = $(this).data('order');
            exOrder = order - 1;
            reorder(order, exOrder);
        });

        generateHeadfilterEvents(grid3);
        $(document).on('keyup', '#searchfilter', function (e) {
            e.preventDefault();
            var action = $('#searchfilter').val();
            if (action.length >= 2) {
                // $.cookie('CouponsSearch', action);
                grid3.setAjaxParam("customActionType", "group_action");
                grid3.setAjaxParam("searchValue", action);
                grid3.setAjaxParam("id", grid3.getSelectedRows());
                grid3.getDataTable().ajax.reload();
            } else {
                // $.removeCookie('CouponsSearch');
                grid3.setAjaxParam("customActionType", "group_action");
                grid3.setAjaxParam("searchValue", action);
                grid3.setAjaxParam("id", grid3.getSelectedRows());
                grid3.getDataTable().ajax.reload();
            }
        });

        $(document).on('change', '#statusfilter', function (e) {
            e.preventDefault();
            var action = $('#statusfilter').val();
            if (action != "") {
                grid3.setAjaxParam("customActionType", "group_action");
                grid3.setAjaxParam("statusValue", action);
                grid3.setAjaxParam("id", grid3.getSelectedRows());
                grid3.getDataTable().ajax.reload();
            } else {
                grid3.setAjaxParam("customActionType", "group_action");
                grid3.setAjaxParam("statusValue", action);
                grid3.setAjaxParam("id", grid3.getSelectedRows());
            }
        });

        $(document).on('change', '#category', function (e) {
            e.preventDefault();
            var action = $('#category').val();

            if (action != "") {
                grid3.setAjaxParam("customActionType", "group_action");
                grid3.setAjaxParam("catValue", action);
                grid3.setAjaxParam("id", grid3.getSelectedRows());
                grid3.getDataTable().ajax.reload();
            } else {
                grid3.setAjaxParam("customActionType", "group_action");
                grid3.setAjaxParam("catValue", action);
                grid3.setAjaxParam("id", grid3.getSelectedRows());
            }
        });

        $(document).on("change", ".publish", function (event, state) {
            //e.preventDefault();
            var controller = $(this).data('controller');
            var alias = $(this).data('alias');
            var val = $(this).data('value');
            var url = site_url + '/' + controller + '/publish';
            $.ajax({
                url: url,
                data: {
                    alias: alias,
                    val: val
                },
                type: "POST",
                dataType: "HTML",
                success: function (data) {
                    grid3.getDataTable().ajax.reload(null, false);
                },
                error: function () {
                    console.log('error!');
                }
            });
        });

        $('a[data-toggle="tab"][id="MenuItem4"]').on('shown.bs.tab', function (e) {
            $("#hidefilter").hide();
            e.preventDefault();
            grid3.setAjaxParam("id", grid3.getSelectedRows());
            grid3.getDataTable().ajax.reload();
        });

        grid3.setAjaxParam("customActionType", "group_action");
        grid3.clearAjaxParams();
        grid3.getDataTable().columns().iterator('column', function (ctx, idx) {
            $(grid3.getDataTable().column(idx).header()).append('<span class="sort-icon"/>');
        });
    }
    return {
        //main function to initiate the module
        init: function () {
            $.fn.DataTable.ext.pager.numbers_length = 4;
            handleRecords3();
        }
    };
}();


// var gridRows4 = 0;  //-- Favorite Tab
// var grid4 = '';
// var TableDatatablesAjax4 = function () {
//     var handleRecords4 = function () {
//         var action = $('#category').val();
//         grid4 = new Datatable();
//         grid4.setAjaxParam("catValue", action);
//         grid4.init({
//             src: $("#datatable_ajax4"),
//             onSuccess: function (grid4, response) {
//                 gridRows4 = response.recordsTotal;
//                 if (response.recordsTotal < 1) {
//                     $('.deleteMass').hide();
//                     $("#menu5.tab-pane .notabreocrd").show();
//                     $("#menu5.tab-pane .withrecords").hide();
//                 } else {
//                     $('.deleteMass').show();
//                     $("#menu5.tab-pane .notabreocrd").hide();
//                     $("#menu5.tab-pane .withrecords").show();
//                 }

//                 if (response.recordsTotal < 20) {
//                     $('.gridjs-pages').hide();
//                 } else {
//                     $('.gridjs-pages').show();
//                 }

//                 if (response.newRecordCount > 0) {
//                     $('.newcounter').text(response.newRecordCount).show();
//                 } else {
//                     $('.newcounter').hide();
//                 }
//                 setTimeout(function () {
//                     $.each(settingarray, function (index, value) {
//                         if (index == 'F') {
//                             $.each(value, function (index, columnid) {
//                                 $('#datatable_ajax4 thead').find('.' + columnid).addClass("hidecolumn");
//                                 $("#datatable_ajax4 tbody").find('tr').each(function (index, value) {
//                                     $(this).find('.' + columnid).addClass("hidecolumn");
//                                 });
//                             });
//                         }
//                     });
//                 }, 1500);
//             },
//             onError: function (grid4) {
//                 // execute some code on network or other general error
//             },
//             onDataLoad: function (grid4) {
//                 $(document).ready(function () {
//                     var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
//                     var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
//                         return new bootstrap.Tooltip(tooltipTriggerEl)
//                     })
//                 });
//                 // execute some code on ajax data load
//                 // $('.make-switch').bootstrapSwitch();
//             },
//             loadingMessage: 'Loading...',
//             dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options
//                 // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
//                 // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
//                 // So when dropdowns used the scrollable div should be removed.
//                 //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
//                 "dom": "t <'gridjs-footer' <'gridjs-pagination'i <'gridjs-pages'p>>>",
//                 "deferRender": true,
//                 // "stateSave": true, // save datatable state(pagination, sort, etc) in cookie.
//                 // "lengthMenu": [
//                 //     [10, 20, 50, 100],
//                 //     [10, 20, 50, 100] // change per page values here
//                 // ],
//                 "pageLength": 20, // default record count per page
//                 // Code for sorting 
//                 "serverSide": true,
//                 "lengthChange": false,
//                 "pagingType": "simple_numbers",
//                 "language": {
//                     "info": '<div role="status" aria-live="polite" class="gridjs-summary">Showing <b>_START_</b> to <b>_END_</b> of <b>_TOTAL_</b> results</div>', // title="Page 1 of 2"
//                 },
//                 "columns": [{
//                         "data": 0,
//                         'class': ' text-center',
//                         'bSortable': false
//                     }, {
//                         "data": 1,
//                         'class': 'text-left Pages_title_P_1 mob-show_div',
//                         'name': 'varTitle'
//                     }, {
//                         "data": 2,
//                         'class': 'text-center Pages_image_P_3',
//                         'bSortable': false
//                     },
// //                    {
// //                        "data": 3,
// //                        'class': 'text-center Pages_image_P_3',
// //                        'bSortable': false
// //                    },
//                     {
//                         "data": 3,
//                         'class': 'text-center Pages_order_P_4',
//                         "name": 'intDisplayOrder'
//                     },
// //                    {
// //                        "data": 4,
// //                        'class': 'text-center form-switch Pages_publish_P_3',
// //                        'name': 'publish',
// //                        'bSortable': false
// //                    },
//                     {
//                         "data": 4,
//                         'class': 'text-center Pages_dactions_P_4 last_td_action mob-show_div',
//                         'bSortable': false
//                     }],
//                 "ajax": {
//                     "url": window.site_url + "/powerpanel/coupons/get_list_favorite", // ajax source
//                 },
//                 'fnCreatedRow': function (nRow, aData, iDataIndex) {
//                 },
//                 "order": [
//                     [4, "desc"]
//                 ]
//             }
//         });

//         $('#datatable_ajax4 tbody').on('click', '.moveDwn', function () {
//             var order = $(this).data('order');
//             exOrder = order + 1;
//             reorder(order, exOrder);
//         });
//         $('#datatable_ajax4 tbody').on('click', '.moveUp', function () {
//             var order = $(this).data('order');
//             exOrder = order - 1;
//             reorder(order, exOrder);
//         });

//         generateHeadfilterEvents(grid4);
//         $(document).on('keyup', '#searchfilter', function (e) {
//             e.preventDefault();
//             var action = $('#searchfilter').val();
//             if (action.length >= 2) {
//                 // $.cookie('CouponsSearch', action);
//                 grid4.setAjaxParam("customActionType", "group_action");
//                 grid4.setAjaxParam("searchValue", action);
//                 grid4.setAjaxParam("id", grid4.getSelectedRows());
//                 grid4.getDataTable().ajax.reload();
//             } else {
//                 // $.removeCookie('CouponsSearch');
//                 grid4.setAjaxParam("customActionType", "group_action");
//                 grid4.setAjaxParam("searchValue", action);
//                 grid4.setAjaxParam("id", grid4.getSelectedRows());
//                 grid4.getDataTable().ajax.reload();
//             }
//         });

//         $(document).on('change', '#statusfilter', function (e) {
//             e.preventDefault();
//             var action = $('#statusfilter').val();
//             if (action != "") {
//                 grid4.setAjaxParam("customActionType", "group_action");
//                 grid4.setAjaxParam("statusValue", action);
//                 grid4.setAjaxParam("id", grid4.getSelectedRows());
//                 grid4.getDataTable().ajax.reload();
//             } else {
//                 grid4.setAjaxParam("customActionType", "group_action");
//                 grid4.setAjaxParam("statusValue", action);
//                 grid4.setAjaxParam("id", grid4.getSelectedRows());
//             }
//         });

//         $(document).on('change', '#category', function (e) {
//             e.preventDefault();
//             var action = $('#category').val();

//             if (action != "") {
//                 grid4.setAjaxParam("customActionType", "group_action");
//                 grid4.setAjaxParam("catValue", action);
//                 grid4.setAjaxParam("id", grid4.getSelectedRows());
//                 grid4.getDataTable().ajax.reload();
//             } else {
//                 grid4.setAjaxParam("customActionType", "group_action");
//                 grid4.setAjaxParam("catValue", action);
//                 grid4.setAjaxParam("id", grid4.getSelectedRows());
//             }
//         });

//         $(document).on("change", ".publish", function (event, state) {
//             //e.preventDefault();
//             var controller = $(this).data('controller');
//             var alias = $(this).data('alias');
//             var val = $(this).data('value');
//             var url = site_url + '/' + controller + '/publish';
//             $.ajax({
//                 url: url,
//                 data: {
//                     alias: alias,
//                     val: val
//                 },
//                 type: "POST",
//                 dataType: "HTML",
//                 success: function (data) {
//                     grid4.getDataTable().ajax.reload(null, false);
//                 },
//                 error: function () {
//                     console.log('error!');
//                 }
//             });
//         });

//         $('a[data-toggle="tab"][id="MenuItem5"]').on('shown.bs.tab', function (e) {
//             $("#hidefilter").hide();
//             e.preventDefault();
//             grid4.setAjaxParam("id", grid4.getSelectedRows());
//             grid4.getDataTable().ajax.reload();
//         });

//         $(document).on("click", '#FgrpChkBox .checkbox_F', function () {
//             if ($(this).prop("checked") == true) {
//                 var datatable_F = $(this).attr("name").split("_");
//                 grid4.getDataTable().column(datatable_F[3]).visible(true);
//                 Cookies.set($(this).attr("name"), 'Y');
//                 grid4.getDataTable().ajax.reload();
//             } else {
//                 var datatable_F = $(this).attr("name").split("_");
//                 grid4.getDataTable().column(datatable_F[3]).visible(false);
//                 Cookies.set($(this).attr("name"), 'N');
//                 grid4.getDataTable().ajax.reload();
//             }
//         });

//         grid4.setAjaxParam("customActionType", "group_action");
//         grid4.clearAjaxParams();
//         grid4.getDataTable().columns().iterator('column', function (ctx, idx) {
//             $(grid4.getDataTable().column(idx).header()).append('<span class="sort-icon"/>');
//         });
//     }
//     return {
//         //main function to initiate the module
//         init: function () {
//             $.fn.DataTable.ext.pager.numbers_length = 4;
//             handleRecords4();
//         }
//     };
// }();

$(window).on('load', function () {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var sterm = urlParams.get('term');
    if (urlParams.has('term')) {
        $('.filter-search').addClass('visible');
        $('#searchfilter').val(sterm);
        $('#searchfilter').trigger('keyup');
    } else {
        if ($.cookie('CouponsSearch')) {
            $('#searchfilter').val($.cookie('CouponsSearch'));
            $('#searchfilter').trigger('keyup');
        }
    }

    /*let urlParams = new URLSearchParams(window.location.search);*/
    if (urlParams.has('category')) {
        let category = urlParams.get('category');
        if (category != '' && category != null) {
            $("#category").val(category);
            $('#category').select2();
            getCategoryData();
        }
    }

});

function getCategoryData() {
    var action = $('#category').val();

    if (action != "") {
        grid.setAjaxParam("customActionType", "group_action");
        grid.setAjaxParam("catValue", action);
        grid.setAjaxParam("id", grid.getSelectedRows());
        grid.getDataTable().ajax.reload();
    } else {
        grid.setAjaxParam("customActionType", "group_action");
        grid.setAjaxParam("catValue", action);
        grid.setAjaxParam("id", grid.getSelectedRows());
    }
}

jQuery(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });
    $("#hidefilter").show();
    TableDatatablesAjax.init();

});


$('a[data-toggle="tab"][id="MenuItem2"]').on('shown.bs.tab', function (e) {
    $("#hidefilter").show();
    if (!$.fn.DataTable.isDataTable('#datatable_ajax_approved')) {
        TableDatatablesAjax1.init();
    }
});
$('a[data-toggle="tab"][id="MenuItem3"]').on('shown.bs.tab', function (e) {
    $("#hidefilter").hide();
    if (!$.fn.DataTable.isDataTable('#datatable_ajax2')) {
        TableDatatablesAjax2.init();
        if (!showChecker) {
            grid2.getDataTable().column(0).visible(false);
        } else {
            grid2.getDataTable().column(0).visible(true);
        }
    }
});
$('a[data-toggle="tab"][id="MenuItem4"]').on('shown.bs.tab', function (e) {
    $("#hidefilter").hide();
    if (!$.fn.DataTable.isDataTable('#datatable_ajax3')) {
        TableDatatablesAjax3.init();
    }
});
$('a[data-toggle="tab"][id="MenuItem5"]').on('shown.bs.tab', function (e) {
    $("#hidefilter").hide();
    if (!$.fn.DataTable.isDataTable('#datatable_ajax4')) {
        TableDatatablesAjax4.init();
        if (!showChecker) {
            grid4.getDataTable().column(0).visible(false);
        } else {
            grid4.getDataTable().column(0).visible(true);
        }
    }
});

function generateHeadfilterEvents(gridvariable) {
    $(document).off('.list_head_filter').on('click', '.list_head_filter', function (e) {
        e.preventDefault();
        var action = $(this).attr("data-filterIdentity");
        if (action != "") {
            gridvariable.setAjaxParam("customActionType", "group_action");
            gridvariable.setAjaxParam("customFilterIdentity", action);
            gridvariable.setAjaxParam("id", gridvariable.getSelectedRows());
            gridvariable.getDataTable().ajax.reload();
        } else {
            gridvariable.setAjaxParam("customActionType", "group_action");
            gridvariable.setAjaxParam("customFilterIdentity", "");
            gridvariable.setAjaxParam("id", gridvariable.getSelectedRows());
        }
    });
    $(document).on('change', '.list_head_filter', function (e) {
        gridvariable.setAjaxParam("customFilterIdentity", "");
    });
    $('.list_head_filter').trigger('change');
}