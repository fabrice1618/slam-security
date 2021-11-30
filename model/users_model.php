<?php
declare(strict_types = 1);
// Utilisation de define pour définir les requetes
define('QUERY_INSERT', "INSERT INTO user (usr_id, usr_email, usr_password, usr_date_connexion, usr_role) VALUES (NULL, :usr_email, :usr_password, :usr_date_connexion, :usr_role) " );
define('QUERY_SELECT', "SELECT * FROM user WHERE usr_id = :usr_id LIMIT 1" );
//define('QUERY_SELECT_EMAIL',  "SELECT * FROM user WHERE usr_email = :usr_email LIMIT 1" );
define('QUERY_UPDATE', "UPDATE user SET usr_email = :usr_email, usr_password = :usr_password, usr_date_connexion = :usr_date_connexion, usr_role = :usr_role WHERE usr_id = :usr_id" );
define('QUERY_DELETE', "DELETE FROM user WHERE usr_id = :usr_id " );
define('QUERY_INDEX',  "SELECT * FROM user" );
class UsersModel extends Model
{
    const TABLENAME = 'users';


    const USR_ACTIVE = [ 'active', 'inactive'];

    const LISTE_CHAMPS = [
        'id_user' => [ 
            'valid' => 'Valid::checkId',
            'default' => 0,
            'pdo_type' => PDO::PARAM_INT,
            //'autoincrement' => true,
            'primary' => true
        ],
        'password' => [ 
            'valid' => 'Valid::checkStr',
            'default' => "",
            'pdo_type' => PDO::PARAM_STR
       ],
        'email' => [ 
            'valid' => 'Valid::checkEmail',
            'default' => null,
            'pdo_type' => PDO::PARAM_STR
        ],
        'prenom' => [ 
            'valid' => 'Valid::checkStr',
            'default' => "",
            'pdo_type' => PDO::PARAM_STR
        ],
        'nom' => [ 
            'valid' => 'Valid::checkStr',
            'default' => "",
            'pdo_type' => PDO::PARAM_STR
        ],
        'id_active' => [ 
            'valid' => 'UsersModel::checkUsrActive',
            'default' => 'inactive',
            'pdo_type' => PDO::PARAM_STR
            ]       
    ];

    public function __construct()
    {
        $aTableDefinition = $this->cleanTableDefinition(self::LISTE_CHAMPS);
        parent::__construct( self::TABLENAME, $aTableDefinition );
    }

    public static function checkUsrActive($val)
    {

        if ( ! is_string($val) || empty($val) || ! in_array($val, self::ID_ACTIVE) ) {
            throw new Exception("Erreur: parametre incorrect - type attendu: id_active");
        }

        return(true);
    }



    // faire le CRUD
    public function create(){
        $iIdCree = 0;

        // Prepare SQL statement
        $stmt1 = $this->dhb->prepare( QUERY_INSERT );
        $stmt1->bindValue(':usr_email', $this->usr_email, PDO::PARAM_STR);
        $stmt1->bindValue(':usr_password', $this->usr_password, PDO::PARAM_STR);
        $stmt1->bindValue(':usr_date_connexion', $this->usr_date_connexion, PDO::PARAM_STR);
        $stmt1->bindValue(':usr_role', $this->usr_role, PDO::PARAM_STR);
        if ( $stmt1->execute() ) {
          // recuperation de l'ID de la ligne crée
          $iIdCree = (int)$this->dbh->lastInsertId();
        }
    
        // MAJ de l'instance avec le usr_id de la database
        $this->usr_id = $iIdCree;
    
        return($iIdCree);
    }

    public function read(){
        $stmt1 = $this->dbh->prepare( QUERY_SELECT );
        $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
        if ( 
            $stmt1->execute() 
            ) {
        $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
    }
    }
    public function update(){
        $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
        $stmt1->bindValue(':usr_email', $this->usr_email, PDO::PARAM_STR);
        $stmt1->bindValue(':usr_password', $this->usr_password, PDO::PARAM_STR);
        $stmt1->bindValue(':usr_date_connexion', $this->usr_date_connexion, PDO::PARAM_STR);
        $stmt1->bindValue(':usr_role', $this->usr_role, PDO::PARAM_STR);
        $stmt1->bindValue(':usr_id', $this->usr_id, PDO::PARAM_INT);
        if ( $stmt1->execute() ) {
    //  echo "Update réussi\n";
    }
    }
    public function delete(){
        $stmt1 = $this->dbh->prepare( QUERY_DELETE );
        $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
        if ( $stmt1->execute() ) {
    //    echo "L'effacement est réussi\n";
    }
    }
    
    public function setRandomPassword()
    {

    $sNewPassword = bin2hex(random_bytes(4));
    $sPasswordHash = $sNewPassword;

    $oUSer->usr_pwd = $sPasswordHash;

    return($sNewPassword);
    }
}
//class UsersModel
//{
//    
//    public function getUsers($Id_user)
//    {
//        $db = $this->dbConnect();
//        $req = $db->prepare('SELECT id_user, Username, Password, date_creation, email, prenom, nom, id_active, id_type FROM Users WHERE id = ?');
//        $req->execute(array($Id_user));
//        $post = $req->fetch();
//
//        return $post;
//    }
//
//
//    public function postUsers($id_user, $Username, $Password, $date_creation, $email, $prenom, $nom, $id_active, $id_type)
//    {
//        $db = $this->dbConnect();
//        $users = $db->prepare('INSERT INTO Users(id_user, Username, Password, date_creation, email, prenom, nom, id_active, id_type) VALUES(?, ?, ?, NOW(), ?, ?, ?, ?, ?)');
//        $affectedLines = $users->execute(array($id_user, $Username, $Password, $date_creation, $email, $prenom, $nom, $id_active, $id_type));
//
//        return $affectedLines;
//    }
//
//
//    private function dbConnect()
//    {
//        $db = new PDO('mysql:host=localhost;dbname=slam_security;charset=utf8', 'root', '');
//        return $db;
//    }
//}



