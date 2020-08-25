<?php 
    if(isset($_SESSION["username"])){
        class Comments extends Controller{

            protected $commentmodel;
            
            function __construct()
            {
                $this->commentmodel = $this->getModel("CommentsModel");
            }

            # Action: Default
            function Default(){
                $this->getView("master2",[
                    "url"   =>  $this->getBaseUrl(),
                    "act"   =>  "comment",
                    "page"  =>  "Comments_View",
                    "list"  =>  $this->commentmodel->GetAllComment()
                ]);
            }

            # Action: Delete Comment
            function delete_Comment($id=0)
            {
                if($id != 0){
                    $result = $this->commentmodel->DeleteComment($id);
                    if($result == "true"){
                        $notice = "Delete comment successfully.";
                    }else{
                        $notice = "Delete comment failed. Please check again.";
                    }
                    $this->getView("master2",[
                        "url"       =>  $this->getBaseUrl(),
                        "act"       =>  "comment",
                        "page"      =>  "Comments_View",
                        "list"      =>  $this->commentmodel->GetAllComment(),
                        "notice"    =>  $notice
                    ]);
                }else{
                    $url = $this->getBaseUrl()."Comments";
                    header("Location : $url");
                }
            }
            

        }

    }else{
        header("Location: localhost:1000/HoangTamMobile/Home");
    }

?>