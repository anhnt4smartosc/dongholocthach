$(document).ready(function () {
    var page = $("#page").val();
    var base_url = $("#base_url").val();
    var id = $("#category_id").val();
    var minprice = $("#minprice").val();
    var maxprice = $("#maxprice").val();
    $("#rangeval").html(minprice + " VNĐ - " + maxprice + " VNĐ");
    $("#rangeslider").slider({
        range: true,
        min: parseInt(minprice),
        max: parseInt(maxprice),
        values: [minprice, maxprice],
        slide: function (event, ui) {
            $("#rangeval").html(ui.values[0] + "  VNĐ - " + ui.values[1] + " VNĐ");
            $("#minprice").val(ui.values[0]);
            $("#maxprice").val(ui.values[1]);
        },
        change: function (event, ui) {
            var pathArray = window.location.pathname.split('/');
            var brand_id, page;
            var order = $("#order_select").val();
            var order_opt = $("#order_opt_select").val();
            if (pathArray.length == 6) {
                page = pathArray[5];
                brand_id = pathArray[4];
            } else if (pathArray.length == 5) {
                page = 1;
                brand_id = pathArray[4];
            }
            ajaxBrand(brand_id, ui.values[0], ui.values[1], page, order, order_opt);
        }
    });

    $("#order_select").live("change", function () {
        var minprice = $("#minprice").val();
        var maxprice = $("#maxprice").val();
        var order = $(this).val();
        var order_opt = $("#order_opt_select").val();
        var pathArray = window.location.pathname.split('/');
        if (pathArray.length == 6) {
            var brand_id = pathArray[4];
        } else if (pathArray.length == 5) {
            var brand_id = pathArray[4];
        }
        ajaxBrand(brand_id, minprice, maxprice, 1, order, order_opt);
    });

    $("#order_opt_select").live("change", function () {
        var minprice = $("#minprice").val();
        var maxprice = $("#maxprice").val();
        var order_opt = $(this).val();
        var order = $("#order_select").val();
        var pathArray = window.location.pathname.split('/');
        if (pathArray.length == 6) {
            var brand_id = pathArray[4];
        } else if (pathArray.length == 5) {
            var brand_id = pathArray[4];
        }
        ajaxBrand(brand_id, minprice, maxprice, 1, order, order_opt);
    });

    $(".checkbrand").change(function () {
        ajaxHomeProduct(page, base_url, id);
    });

    $("#pager ul li a").live("click", function (e) {
        e.preventDefault();
        var link = ($(this).attr('href'));
        var page = 1
        var res = link.split("/");
        if (res.length == 8) {
            ;
            page = res[7];
        }
        var minprice = $("#minprice").val();
        var maxprice = $("#maxprice").val();
        var brand_id = $("#brand_id").val();
        var order = $("#order_select").val();
        var order_opt = $("#order_opt_select").val();
        ajaxBrand(brand_id, minprice, maxprice, page, order, order_opt);
    });
    $(function () {
        $("img.lazy").lazyload({
            event: "sporty",
            effect:"fadeIn"
        });
    });
    $(window).bind("load", function () {
        var timeout = setTimeout(function () {
            $("img.lazy").trigger("sporty")
        }, 1000);
    });
});
function ajaxBrand(brand_id, min_price, max_price, page, order, order_opt) {
    $('#content').html('<span id="wait-ui-icon">Loading...</span>');
    $.ajax({
        url: "/default/home/ajaxBrand/" + brand_id + "/" + page,
        async: true,
        type: "POST",
        data: "min_price=" + min_price + "&max_price=" + max_price + "&order=" + order + "&order_opt=" + order_opt,
        success: function (result) {
            setTimeout(5000);
            $("#content").html(result);
        }
    });
}

