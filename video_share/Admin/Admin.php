<?php

require_once ("User.php");

class Admin extends User {

    function deleteChannel($channelId) {
        global $conn;
        $deleteQuery = "DELETE c, v FROM channel c  LEFT JOIN  videos v ON c.channelId = v.channelId WHERE c.channelId=$channelId";

        $result = $conn->query($deleteQuery);
        if ($result !== false) {
            if ($conn->affected_rows > 0) {
                $this->lastSuccessMessage = "delete channel successfully";
                return true;
            } else {
                $this->lastErrorMessage = "channel not found";
                return false;
            }
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }

    function deleteComment($commentId) {
        global $conn;
        $deleteQuery = "DELETE FROM comments WHERE commentsId=$commentId";
        $result = $conn->query($deleteQuery);
        if ($result !== false) {
            if ($conn->affected_rows > 0) {
                $this->lastSuccessMessage = "delete comment successfully";
                return true;
            } else {
                $this->lastErrorMessage = "comment not found";
                return false;
            }
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }

    function addCategory($categoryName) {
        global $conn;
        $categoryQuery = "INSERT INTO category (`categoryName`) VALUES('$categoryName');";
        $result = $conn->query($categoryQuery);
        if ($result !== false) {
            $this->lastSuccessMessage = "add category successfully";
            return true;
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }

    function editCategory($categoryId, $categoryName) {
        global $conn;
        $editQuery = "UPDATE category SET `categoryName` = '$categoryName' WHERE categoryId=$categoryId;";
        $result = $conn->query($editQuery);
        if ($result !== false) {
            if ($conn->affected_rows > 0) {
                $this->lastSuccessMessage = "edit category successfully";
                return true;
            } else {
                $this->lastErrorMessage = "category not found or no change happen";
                return false;
            }
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }

    function deleteCategory($categoryId) {
        global $conn;
        $deleteQuery = "DELETE c, v FROM category c LEFT JOIN  videos v ON c.categoryId = v.VideoCategory  WHERE  c.categoryId = '$categoryId'";

        $result = $conn->query($deleteQuery);
        if ($result !== false) {
            if ($conn->affected_rows > 0) {
                $this->lastSuccessMessage = "delete category successfully";
                return true;
            } else {
                $this->lastErrorMessage = "category not found";
                return false;
            }
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }

    function showUsers() {
        global $conn;
        $usersQuery = "SELECT * FROM user;";
        $result = $conn->query($usersQuery);
        if ($result === false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function showNewComments() {
        global $conn;
        $usersQuery = "SELECT * FROM comments JOIN user ON comments.userId=user.userId where comments.commentDate = CURDATE();";
        $result = $conn->query($usersQuery);
        if ($result == false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function showNewVideosReports() {
        global $conn;
        $usersQuery = "SELECT * FROM reportedvideos r LEFT JOIN videos v ON r.videoId=v.videoId WHERE reportDate =CURDATE();";
        $result = $conn->query($usersQuery);
        if ($result == false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function countNewVideosReports() {
        global $conn;
        $usersQuery = "SELECT COUNT(*) AS newVideosReportNumbers FROM reportedvideos WHERE reportDate =CURDATE();";
        $result = $conn->query($usersQuery);
        if ($result == false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function showNewCommentReports() {
        global $conn;
        $usersQuery = "SELECT * FROM reportedcomment r LEFT JOIN comments c ON r.commentId=c.commentsId WHERE reportDate =CURDATE();";
       
        $result = $conn->query($usersQuery);
        if ($result == false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function countNewCommentReports() {
        global $conn;
        $usersQuery = "SELECT COUNT(*) AS newVideosReportNumbers FROM reportedcomment WHERE reportDate =CURDATE();";
        $result = $conn->query($usersQuery);
        if ($result == false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function showVideosReports() {
        global $conn;
        $usersQuery = "SELECT * FROM reportedvideos r LEFT JOIN videos v ON r.videoId=v.videoId;";
        $result = $conn->query($usersQuery);
        if ($result == false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function showCommentsReports() {
        global $conn;
        $usersQuery = "SELECT * FROM reportedcomment r LEFT JOIN comments c ON r.commentId=c.commentsId;";
        $result = $conn->query($usersQuery);
        if ($result == false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function showVideos() {
        global $conn;
        $usersQuery = "SELECT * FROM videos;";
        $result = $conn->query($usersQuery);
        if ($result === false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function blockUser($userId) {
        global $conn;
        $blockQuery = "UPDATE user SET blockState = 1 WHERE userId = '$userId';";
        $result = $conn->query($blockQuery);
        if ($result !== false) {
            if ($conn->affected_rows > 0) {
                $this->lastSuccessMessage = "block successfully";
                return true;
            } else {
                $this->lastErrorMessage = "user not found or already blocked";
                return false;
            }
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }

    function unBlockUser($userId) {
        global $conn;
        $unBlockQuery = "UPDATE user SET blockState = 0 WHERE userId = '$userId';";
        $result = $conn->query($unBlockQuery);
        if ($result !== false) {
            if ($conn->affected_rows > 0) {
                $this->lastSuccessMessage = "unblock successfully";
                return true;
            } else {
                $this->lastErrorMessage = "user not found or already unblocked";
                return false;
            }
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }

    //#/
    function videoReportAction($action, $reportId) {
        global $conn;
        $editQuery = "UPDATE reportedvideos SET action=$action WHERE reportId=$reportId;";
        $result = $conn->query($editQuery);
        if ($result !== false) {
            $this->lastSuccessMessage = "report action  successfully";
            return true;
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }

    //#/
    function commentReportAction($action, $reportId) {
        global $conn;
        $editQuery = "UPDATE reportedcomment SET action=$action WHERE reportId=$reportId;";
        $result = $conn->query($editQuery);
        if ($result !== false) {
            $this->lastSuccessMessage = "report action  successfully";
            return true;
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }

    function deleteVideo($videoId) {
        global $conn;
        $deleteVideo = "DELETE FROM videos WHERE videoId='$videoId';";
        $result = $conn->query($deleteVideo);
        if ($result !== false) {
            if ($conn->affected_rows > 0) {
                $this->lastSuccessMessage = "delete video successfully";
                return true;
            } else {
                $this->lastErrorMessage = "video not found";
                return false;
            }
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }

    function showChannels() {
        global $conn;
        $usersQuery = "SELECT * FROM channel";
        $result = $conn->query($usersQuery);
        if ($result === false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function countActiveUsers() {
        //SELECT COUNT(*) AS NumberOfOrders FROM Orders;
        global $conn;
        $usersQuery = "SELECT COUNT(*) AS activeUsers FROM user where blockState is NULL";
        $result = $conn->query($usersQuery);
        if ($result === false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function countBlockedUsers() {
        global $conn;
        $usersQuery = "SELECT COUNT(*) AS blockedUsers FROM user where blockState=1;";
        $result = $conn->query($usersQuery);
        if ($result === false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function countvideos() {
        global $conn;
        $usersQuery = "SELECT COUNT(*) AS videosNumbers FROM videos;";
        $result = $conn->query($usersQuery);
        if ($result === false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

    function countchannel() {
        global $conn;
        $usersQuery = "SELECT COUNT(*) AS channelNumbers FROM channel;";
        $result = $conn->query($usersQuery);
        if ($result === false) {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
        return $result;
    }

}
