$(function() {

    //RANGER SLIDER-------------------------------------------------------------
    var minPrice = $('#minPrice').val();
    var maxPrice = $('#maxPrice').val();
    var base_url = $('#base_url').val();

    console.log(base_url);
    console.log(minPrice);
    console.log(maxPrice);

    $('#allBrand').change(function(){
    var brandCurrent = $(this).val();
    sliderProcess(brandCurrent, minPrice, maxPrice);
    });

    $('#rangeslider').slider({
        range: true,
        min: parseInt(minPrice),
        max: parseInt(maxPrice),
        values: [ minPrice, maxPrice ],
        slide: function( event, ui ) {
        $('#rangeval').html(ui.values[0]+" - "+ui.values[1]);
        $("#minPrice").val(ui.values[0]);
        $("#maxPrice").val(ui.values[1]);
        var brandCurrent = $('#allBrand').val();
        sliderProcess(brandCurrent, ui.values[0], ui.values[1]);
        }
    });

    function sliderProcess(brandCurrent, minPrice, maxPrice){
        $.ajax({
            type: "post",
            data: "data=" + brandCurrent + "," + minPrice + "," + maxPrice,
            url: base_url + "default/filter/filterProcess",
            success: function(result){
                var obj = $.parseJSON(result);
                html ="";
                $.each(obj,function(index, value){
                    html +="<tr>";
                    html +="<td><img style='width: 50px;height: 50px' src='"+ base_url +"public/admin/images/"+ value['image_path']+ "' /></td>";
                    html +="<td>"+ value['product_name']+" </td>";
                    html +="<td>"+ value['product_price']+"00000 đồng</td>";
                    html +="</tr>";
                });
            $("#showdata").children().remove();
            $("#showdata").append(html);
            }
        })
    };
});