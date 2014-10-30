//$(document).ready(function(){
////    var page = $("#page").val();
////    var base_url = $("#base_url").val();
////    var brand_id = $("#brand_id").val();
////    var minprice = $("#minprice").val();
////    var maxprice = $("#maxprice").val();
//
//
//    $("#rangeslider").slider({
//        change:function(){
//            alert("asdf");
//        }
//    });
////    $("#rangeval").html(minprice+" - "+maxprice+" VND");
////    $("#rangeslider").slider({
////        range:true,
////        min:parseInt(minprice),
////        max:parseInt(maxprice),
////        values:[minprice,maxprice],
////        slide:function(event,ui){
////            $("#rangeval").html(ui.values[0]+"-"+ui.values[1]+"VNĐ");
////            $("#minprice").val(ui.values[0]);
////            $("#maxprice").val(ui.values[1]);
////        },
////        change:function(event,ui){
////            alert("asdf");
////        }
////    });
////
////    $("#order_select").live("change", function (){
////        ajaxHomeProduct(page,base_url,id);
////    });
////
////    $("#order_opt_select").change(function (){
////        ajaxHomeProduct(page,base_url,id);
////    });
////
////    $(".checkbrand").change(function(){
////        ajaxHomeProduct(page,base_url,id);
////    });
////
////    $("#pager").on("click","a",function(e){
////        e.preventDefault();
////        var pageNum = $(this).text();
////        ajaxHomeProduct(pageNum,base_url,id);
////    })
////    $("#pager ul li a").click(function(){
////        var pageNum = $(this).text();
////        ajaxHomeProduct(pageNum,base_url,id);
////        return false;
////    });
//});
//
//function ajaxBrand(brand_id)
//{
//    var minprice = $("#minprice").val();
//    var maxprice = $("#maxprice").val();
//
//    $.ajax({
//        url:"default/home/ajaxBrand/",
//        type:"POST",
//        data:"brand_id="+brand_id+"&minprice="+minprice+"&maxprice="+maxprice,
//        success:function(result){
//            $("#content").html('asdfasdf');
//        }
//    });
//}
//
