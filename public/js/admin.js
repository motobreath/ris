$(function(){

    //assign delete to admin users table
    if($("#administratorsTable").size()>0){
        $("#administratorsTable .DA").click(function(){
            var self=$(this);
            var admin=$(this).data("admin");
            var url="/admin/users/modifyadmin";
            var data={
                "admin":admin,
                "format":"json"
            };
            $.when($.post(url,data)).then(function(){
                self.closest("tr").remove();
                $(".msg.short").remove();
                $("#administratorsTable").before("<p class='msg short'>Success! The admin has been deleted")
            },function(){
                $(".error.short").remove();
                $("#administratorsTable").before("<p class='error short'>There was an error deleting that admin, someone has been notified and we'll fix that up shortly.");
            })
        })
    }
})