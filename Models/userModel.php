<?php
function createUser($pdo)
{
    try{
        $query = "insert into utilisateur (utilisateurPseudo, utilisateurMdp, utilisateurEmail, utilisateurRole) values (:nomUser, :mdpUser, :mailUser, :roleUser)"; //nom des colonnes utilisateur
        $newUser = $pdo->prepare($query);
        $newUser->execute([
            'nomUser' => htmlentities($_POST["pseudo"]),
            'mailUser' => htmlentities($_POST["mail"]),
            'mdpUser' => htmlentities($_POST["password"]),
            'roleUser' => 'membre' 
            
        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function connectUser($pdo){
    try {
        $query = "select * from utilisateur where utilisateurPseudo = :loginUser and utilisateurMdp = :passwordUser";
        $connectUser = $pdo->prepare($query);
        $connectUser->execute([
            'loginUser' => htmlentities($_POST['pseudo']),
            'passwordUser' => htmlentities($_POST['password']),
        ]);
        $user = $connectUser->fetch();

        if($user)
        {
            $_SESSION['user'] = $user;
        }
        else{
            $messageErrorLogin = "Votre pseudo ou mot de passe est invalide";
            return $messageErrorLogin;
        }
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
function updateUser($pdo)
{
    try {
        $query = "UPDATE utilisateur SET utilisateurPseudo = :utilisateurPseudo, utilisateurMdp = :utilisateurMdp, utilisateurEmail = :utilisateurEmail WHERE utilisateurId = :id";
        $updateUser = $pdo->prepare($query);
        $updateUser->execute([
            'utilisateurPseudo' => htmlentities($_POST['pseudo']),
            'utilisateurMdp' => htmlentities($_POST['password']),
            'utilisateurEmail' => htmlentities($_POST['mail']),
            'id' => $_SESSION["user"]->utilisateurId
        ]);
        reloadSession($pdo);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function reloadSession($pdo)
{
    try {
        $query = "select * from utilisateur where utilisateurId = :id";
        $chercheUser = $pdo->prepare($query);
        $chercheUser->execute([
            'id' => $_SESSION["user"]->utilisateurId
        ]);
        $user=$chercheUser -> fetch();
        if ($user) {
            $_SESSION['user']=$user;
        }
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}



function deleteUser($pdo)
{
    try {
        $query = "update score set utilisateurId=null where utilisateurId = :id";
        $updateScoreUser = $pdo->prepare($query);
        $updateScoreUser->execute([
            'id' => $_SESSION["user"]->utilisateurId
        ]);
        $query = "update quizz set utilisateurId=null where utilisateurId = :id";
        $updateQuizzUser = $pdo->prepare($query);
        $updateQuizzUser->execute([
            'id' => $_SESSION["user"]->utilisateurId
        ]);
        $query = "delete from utilisateur where utilisateurId = :id";
        $deleteUser = $pdo->prepare($query);
        $deleteUser->execute([
            'id' => $_SESSION["user"]->utilisateurId
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function testConversation($pdo)
{
    try{
        $query = " SELECT * FROM alexandre.utilisateur_conversation natural join conversation where utilisateurId = :userId1 and conversationId in (SELECT conversationId FROM alexandre.utilisateur_conversation where utilisateurId = :userId2) and conversationType = 'binaire'";

        $selectAllUser = $pdo->prepare($query);
        $selectAllUser->execute([
            'userId1' => $_SESSION['user']->utilisateurId, 
            'userId2' => $_GET['utilisateurId']
        ]);
        $users = $selectAllUser->fetch();

        return $users;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}


function selectAllConversationGroupe($pdo)
{
    try{
        $query = " SELECT * FROM conversation where conversationType = 'groupe'";

        $selectAllUser = $pdo->prepare($query);
        $selectAllUser->execute();
        $groupes = $selectAllUser->fetchAll();

        return $groupes;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}

function recupAllMessage($pdo,$conversationId)
{
    try{
        $query = "select * from message where conversationId = :conversationId";

        $selectAllUser = $pdo->prepare($query);
        $selectAllUser->execute([
            'conversationId' => $conversationId
        ]);
        $messages = $selectAllUser->fetchAll();

        return $messages;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}

function envoieMessage($pdo,$conversationId)
{
    try{
        $query = "INSERT INTO message (messageText, messageDate, messageHeure,conversationId,utilisateurId) VALUES (:messageText, CAST(NOW() AS DATE), CAST(NOW() AS TIME),:conversationId,:utilisateurId);";

        $selectAllUser = $pdo->prepare($query);
        $selectAllUser->execute([
            'messageText' => htmlentities($_POST['textMessage']),
            'conversationId' => $conversationId,
            'utilisateurId' => $_SESSION['user']->utilisateurId,


        ]);
        $groupes = $selectAllUser->fetchAll();

        return $groupes;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function updateMessage($pdo)
{
    try{
        $query = "update message set messageText = 'message suprimmer par son redacteur'  where messageId = :messageId";

        $selectAllUser = $pdo->prepare($query);
        $selectAllUser->execute([
            'messageId' => $_GET['messageId'],
        ]);
        $groupes = $selectAllUser->fetchAll();

        return $groupes;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}

function deleteMessage($pdo)
{
    try{
        $query = "delete from message where messageId = :messageId";

        $selectAllUser = $pdo->prepare($query);
        $selectAllUser->execute([
            'messageId' => $_GET['messageId'],
        ]);
        $groupes = $selectAllUser->fetchAll();

        return $groupes;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}

function createConversationGroupe($pdo)
{
    try{
        $query = "INSERT INTO conversation (conversationType) VALUES ('groupe')";
        $nouvelleConversation = $pdo->prepare($query);
        $nouvelleConversation->execute();
        $conversationId = $pdo->lastInsertId();
        foreach($_POST['utilisateurGroupe'] as $utilisateurGroupe){

            $query = "INSERT INTO utilisateur_conversation (conversationId,utilisateurId) VALUES (:conversationId,:utilisateurId)";
            $nouvelleConversation = $pdo->prepare($query);
            $nouvelleConversation->execute([
                'conversationId' => $conversationId,
                'utilisateurId' => $utilisateurGroupe, 
            ]);
        }
        
        $query = "INSERT INTO utilisateur_conversation (conversationId,utilisateurId) VALUES (:conversationId,:utilisateurId)";
        $nouvelleConversation = $pdo->prepare($query);
        $nouvelleConversation->execute([
            'conversationId' => $conversationId,
            'utilisateurId' => $_SESSION['user']->utilisateurId, 
        ]);
        return $conversationId;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}









function createConversation($pdo)
{
    try{
        $query = "INSERT INTO conversation (conversationType) VALUES ('binaire')";
        $nouvelleConversation = $pdo->prepare($query);
        $nouvelleConversation->execute();
        $conversationId = $pdo->lastInsertId();
        $query = "INSERT INTO utilisateur_conversation (conversationId,utilisateurId) VALUES (:conversationId,:utilisateurId)";
        $nouvelleConversation = $pdo->prepare($query);
        $nouvelleConversation->execute([
            'conversationId' => $conversationId,
            'utilisateurId' => $_SESSION['user']->utilisateurId, 
        ]);
        $query = "INSERT INTO utilisateur_conversation (conversationId,utilisateurId) VALUES (:conversationId,:utilisateurId)";
        $nouvelleConversation = $pdo->prepare($query);
        $nouvelleConversation->execute([
            'conversationId' => $conversationId,
            'utilisateurId' => $_GET['utilisateurId'], 
        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}




function selectAllUserExceptConnected($pdo)
{
    try{
        $query = "select * from utilisateur where utilisateurId != :utilisateurId"; //nom des colonnes utilisateur
        $selectAllUser = $pdo->prepare($query);
        $selectAllUser->execute([
            'utilisateurId' => $_SESSION['user']->utilisateurId, 
            
        ]);
        $users = $selectAllUser->fetchAll();
        return $users;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}