<?php
declare(strict_types = 1);
class UsersModel extends Model
{
    const TABLENAME = 'users';

    const USR_TYPE = [ 
        'guest' => 'Invité', 
        'user' => 'Utilisateur', 
        'admin' => 'Administrateur'
    ];

    const USR_ACTIVE = [ 'active', 'inactive'];

    const LISTE_CHAMPS = [
        'id_user' => [ 
            'valid' => 'Valid::checkId',
            'default' => 0,
            'pdo_type' => PDO::PARAM_INT,
            //'autoincrement' => true,
            //'primary' => true
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
        'id_type' => [ 
            'valid' => 'UsersModel::checkUsrType',
            'default' => 'guest',
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

    public static function checkUsrType($val)
    {

        if ( ! is_string($val) || empty($val) || ! array_key_exists($val, self::ID_TYPE) ) {
            throw new Exception("Erreur: parametre incorrect - type attendu: id_type");
        }

        return(true);
    }

    public static function checkUsrActive($val)
    {

        if ( ! is_string($val) || empty($val) || ! in_array($val, self::ID_ACTIVE) ) {
            throw new Exception("Erreur: parametre incorrect - type attendu: id_active");
        }

        return(true);
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