///**
// * Created by theghoul on 7/17/14.
// */
//
//
//function ajaxListUser(page,sortby,typesort,base_url)
//{
//	$.ajax({
//		url:base_url+"admin/user/ajaxUser",
//		type:"POST",
//		data:"page="+page+"&sortby="+sortby+"&typesort="+typesort,
//		success:function(result){
//			var obj = $.parseJSON(result);
//			html ="";
//			$.each(obj,function(insex,value)
//			{
//				html +="<tr>";
//				html +="<td>"+value["user_name"]+"</td>";
//				html +="<td>"+value["user_fullName"]+"</td>";
//				html +="<td>"+value["user_email"]+"</td>";
//				html +="<td>"+value["user_address"]+"</td>";
//				html +="<td>"+value["user_phone"]+"</td>";
//				html +="<td>"+value["user_gender"]+"</td>";
//				html +="<td><a href='"+base_url+"admin/user/update/"+value["user_id"]+"'>update</a></td>";
//				html +="<td><a href='"+base_url+"admin/user/delete/"+value["user_id"]+"'>delete</a></td>";
//				html +="</tr>";
//			});
//			$("#showdata").children().remove();
//			$("#showdata").append(html);
//		}
//	});
//}
//function ajaxSearchProduct(page,search_name,base_url)
//{
//    $.ajax({
//        url:base_url+"admin/product/ajaxSearchProduct",
//        type:"POST",
//        data:"page="+page+"&searchName="+search_name,
//        success: function(result){
//            var obj = $.parseJSON(result);
//            html ="";
//            var i=0;
//            $.each(obj,function(index,value){
//                var xclass = (i%2)?"odd":"even";
//                html+= "<tr>";
//                html+= "<tr id="+value['product_id']+" class='"+xclass+"'>";
//                html+= "<td><img class='thumbnail' src='"+base_url+"public/admin/images/"+value['image_path']+"'></td>";
//                html+= "<td>"+value['product_name']+"</td>";
//                html+= "<td>"+value['product_date']+"</td>";
//                html+= "<td>"+value['product_price']+"</td>";
//                html+= "<td>"+value['product_sale']+"%</td>";
//                html+= "<td>"+value['brand_name']+"</td>";
//                html+= "<td><a href='"+base_url+"admin/product/update/"+value['product_id']+"'>Update</td>";
//                html+= "<td><a href='"+base_url+"admin/product/delete/"+value['product_id']+"'>Delete</td>";
//                html+="</tr>";
//
//            });
//            $("#showdata").children().remove();
//            $("#showdata").append(html);
//        }
//    });
//}
//    function ajaxReportProduct(page,base_url,datestart,dateend)
//    {
//        $.ajax({
//            url:base_url+"admin/report/ajaxReportProduct",
//            type:"POST",
//            data:"page="+page+"&datestart="+datestart+"&dateend="+dateend,
//            success:function(result){
//                var obj = $.parseJSON(result);
//                html ="";
//                var i=0;
//                $.each(obj,function(index,value){
//                    var xclass = (i%2)?"odd":"even";
//                    html+= "<tr>";
//                    html+= "<tr id="+value['product_id']+" class='"+xclass+"'>";
//                    html+= "<td><img class='thumbnail' src='"+base_url+"public/admin/images/"+value['image_path']+"'></td>";
//                    html+= "<td>"+value['product_name']+"</td>";
//                    html+= "<td>"+value['product_price']+"</td>";
//                    html+= "<td>"+value['product_sale']+"</td>";
//                    html+= "<td>"+value['brand_name']+"</td>";
//                    html+= "<td>"+value['total']+"</td>";
//                    html+= "<td><a href='"+base_url+"admin/product/update/"+value['product_id']+"'>Update</td>";
//                    html+="</tr>";
//
//                });
//                $("#showdata").children().remove();
//                $("#showdata").append(html);
//            }
//        });
//
//}
//

/**
 * Created by theghoul on 7/17/14.
 */


function ajaxListUser(page,sortby,typesort,base_url)
{
    $.ajax({
        url:base_url+"admin/user/ajaxUser",
        type:"POST",
        data:"page="+page+"&sortby="+sortby+"&typesort="+typesort,
        success:function(result){
            var obj = $.parseJSON(result);
            html ="";
            $.each(obj,function(insex,value)
            {
                html +="<tr>";
                html +="<td>"+value["user_name"]+"</td>";
                html +="<td>"+value["user_fullName"]+"</td>";
                html +="<td>"+value["user_email"]+"</td>";
                html +="<td>"+value["user_address"]+"</td>";
                html +="<td>"+value["user_phone"]+"</td>";
                html +="<td>"+value["user_gender"]+"</td>";
                html +="<td><a href='"+base_url+"admin/user/update/"+value["user_id"]+"'>update</a></td>";
                html +="<td><a href='"+base_url+"admin/user/delete/"+value["user_id"]+"'>delete</a></td>";
                html +="</tr>";
            });
            $("#showdata").children().remove();
            $("#showdata").append(html);
        }
    });
}
function ajaxSearchProduct(page,search_name,base_url)
{
    $.ajax({
        url:base_url+"admin/product/ajaxSearchProduct",
        type:"POST",
        data:"page="+page+"&searchName="+search_name,
        success: function(result){
            var obj = $.parseJSON(result);
            html ="";
            var i=0;
            $.each(obj,function(index,value){
                var xclass = (i%2)?"odd":"even";
                html+= "<tr>";
                html+= "<tr id="+value['product_id']+" class='"+xclass+"'>";
                html+= "<td><img class='thumbnail' src='"+ value['image_path']+"'></td>";
                html+= "<td>"+value['product_name']+"</td>";
                html+= "<td>"+value['product_date']+"</td>";
                html+= "<td>"+value['product_price']+"</td>";
                html+= "<td>"+value['product_sale']+"%</td>";
                html+= "<td>"+value['brand_name']+"</td>";
                html+= "<td><a href='"+base_url+"admin/product/edit/"+value['product_id']+"'>Update</td>";
                html+= "<td><a href='"+base_url+"admin/product/delete/"+value['product_id']+"'>Delete</td>";
                html+="</tr>";

            });
            $("#showdata").children().remove();
            $("#showdata").append(html);
        }
    });
}
function ajaxReportProduct(page,base_url,datestart,dateend)
{
    $.ajax({
        url:base_url+"admin/report/ajaxReportProduct",
        type:"POST",
        data:"page="+page+"&datestart="+datestart+"&dateend="+dateend,
        success:function(result){
            var obj = $.parseJSON(result);
            html ="";
            var i=0;
            $.each(obj,function(index,value){
                var xclass = (i%2)?"odd":"even";
                html+= "<tr>";
                html+= "<tr id="+value['product_id']+" class='"+xclass+"'>";
                html+= "<td><img class='thumbnail' src='"+value['image_path']+"'></td>";
                html+= "<td>"+value['product_name']+"</td>";
                html+= "<td>"+value['product_price']+"</td>";
                html+= "<td>"+value['product_sale']+"</td>";
                html+= "<td>"+value['brand_name']+"</td>";
                html+= "<td>"+value['total']+"</td>";
                html+= "<td><a href='"+base_url+"admin/product/edit/"+value['product_id']+"'>Update</td>";
                html+="</tr>";

            });
            $("#showdata").children().remove();
            $("#showdata").append(html);
        }
    });

}
