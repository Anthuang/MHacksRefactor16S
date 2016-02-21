$(document).ready(function() {

	$(document).on("click", ".class_EditButton", function() {
		$("#id_ID").val($(this).parent().siblings(".class_ListID").val());
        $("#id_ReqLat").val($(this).parent().siblings(".class_ListLat").html());
        $("#id_ReqLng").val($(this).parent().siblings(".class_ListLng").html())
        if ($(this).val() == 1) {
            $("#id_ListForm").submit();
        } else {
            $("#id_ListForm").attr("action", "lost.php");
            $("#id_ListForm").submit();
        }
	});

});