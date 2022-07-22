<?php
class Article {
    private $conn;
    function __construct($conn) {
       $this->conn=$conn;
    }


    public function getArticles(){
        $sql = "SELECT * FROM article";
        $result = $this->conn->query($sql);
        $output = array();
    
        while($r = mysqli_fetch_assoc($result)) {
            $output[] = $r;
        }

        echo json_encode($output);
    }


    function getArticle($id){
        $sql = 'select * from article where id ='.$id;

        $result = $this->conn->query($sql);
        $output = array();
    
        while($r = mysqli_fetch_assoc($result)) {
            $output[] = $r;
        }

        echo json_encode($output[0]);
    }

    function delete($id){
        $sql = 'delete from article where id ='.$id;
        if ($this->conn->query($sql)) {
            echo "Record deleted successfully";
        } else {
            return http_response_code(422);;
        }
         
    }
    function update($id,$article){
    
    $request = json_decode($article,true);
    $Title = mysqli_real_escape_string($this->conn, trim($request['Title']));
	$content = mysqli_real_escape_string($this->conn, trim($request['content']));
    $author = mysqli_real_escape_string($this->conn, trim($request['author']));
	$upvote = mysqli_real_escape_string($this->conn, (int)$request['upvote']);
    $downvote = mysqli_real_escape_string($this->conn, (int)$request['downvote']);
	$sql = "UPDATE article SET Title='$Title',content='$content',author='$author',upvote='$upvote',downvote='$downvote' WHERE id = $id";
	
	if($this->conn->query($sql))
	{
		http_response_code(204);
	}
	else
	{
		return http_response_code(422);
	}   
    }
    function create($article){
    
        $request = json_decode($article,true);
        $id = mysqli_real_escape_string($this->conn, (int)$request['id']);
        $Title = mysqli_real_escape_string($this->conn, trim($request['Title']));
        $content = mysqli_real_escape_string($this->conn, trim($request['content']));
        $author = mysqli_real_escape_string($this->conn, trim($request['author']));
        $upvote = mysqli_real_escape_string($this->conn, (int)$request['upvote']);
        $downvote = mysqli_real_escape_string($this->conn, (int)$request['downvote']);
        $sql = "insert into article (id,Title,content,author,upvote,downvote) values ('$id','$Title','$content','$author','$upvote','$downvote')";
        
        if($this->conn->query($sql))
        {
            http_response_code(204);
        }
        else
        {
            return http_response_code(422);
        }   
        }

}

 ?>