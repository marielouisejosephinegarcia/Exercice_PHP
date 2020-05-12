<?php
class Validator {
    
    private $errors=[];

    public function getErrors(){
           return $this->errors;
    }

    public function is_valid(){
       return count($this->errors)===0;
    }

 // Longueur et Largueur doivent etre numeric(entier,reel)
 public function is_number($nombre,$key,$errorMessage="Veuiller saisir un nombre"){
    $this->is_empty($nombre,$key);
    if($this->is_valid()){
    if(!is_numeric($nombre)){
        $this->errors[$key]= $errorMessage;
    }
}
}

/*
  Longueur positif
  Largeur positif
*/
public function is_positif($nombre,$key,$errorMessage="Veuiller saisir un nombre positif"){
                   $this->is_number($nombre,$key);
                   if($this->is_valid()){
                      if($nombre<=0){
                        $this->errors[$key]= $errorMessage;
                      }
                    }
                   
}

/**
*   Longueur> Largeur
*/
//compare()
//Nbre1 =>plus grand
//Nbre2 =>plus petit
public function compare($nbre1,$nbre2,$key1,$key2,$errorMessage="Longueur doit superieur à la Largeur"){
    $this->is_positif($nbre1,$key1);
    $this->is_positif($nbre2,$key2);
   if($this->is_valid()){
           if($nbre1<=$nbre2){
              $this->errors['all']=$errorMessage;
           }
   }

}

public function  is_empty($nbre,$key,$sms=null){
    if(empty($nbre)){
        if($sms==null){
            $sms="Le Nombre  est Obligatoire";
        }
        $this->errors[$key]= $sms;

        }
    }
//Expressions Régulières
    public function  is_email($valeur,$key,$sms=null){
        if(empty($valeur)){
            if(!(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $valeur))) {//$valeur=mouhgta14@ism.edu.sn
                $sms="L'email saisi n'est pas valide";
        }
        $this->errors[$key]= $sms;
    }
    
    }
    //9chiffres , commence par 77,78,75,76,70
    public function  is_telephone($valeur,$operateur,$key,$sms=null){
        if(!(empty($valeur))){
                //Supprimer tous les caractères qui ne sont pas des chiffres 
                if(preg_replace('/[^0-9]+/', '', $valeur)){
                    $sms="Saisir un bon numero";
                    return $valeur;
                }
                //Garder les 9 derniers chiffres
                $valeur = substr($valeur,-8); 
                $operateur=substr($valeur,2);
                
                if (!($operateur="77" || $operateur="78" || $operateur="70" || $operateur="76")) {
                    $sms="Le numero saisi n'est pas reconnu";
                    
                }else{
                    return $valeur;
                }
                
                
            } 
            $sms="Le numero est obligatoire";
            $this->errors[$key]= $sms;
        }
    
}
?>