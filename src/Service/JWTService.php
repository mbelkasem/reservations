<?php 

namespace App\Service;

use DateTimeImmutable;

class JWTService{

    //On génère le token   

    public function generate(array $header, array $payload, string $secret, int $validity=1800): string {

        if($validity > 0){

          $now = new DateTimeImmutable();
          $exp = $now->getTimestamp() + $validity;
  
          $payload['iat'] = $now->getTimestamp(); 
          $payload['exp'] = $exp;
        }        

        // On encode en base64
        $base64Header = base64_encode(json_encode($header));
        $base64Payload = base64_encode(json_encode($payload));


        //On nettoie les valeurs encodées (retrait des +, ? et =)
        $base64Header = str_replace(['+' , '/', '='], ['-' , '_' , ''], $base64Header);
        $base64Paylaod = str_replace(['+' , '/', '='], ['-' , '_' , ''], $base64Payload);

        //On génère la signature (il faut un secret)
        $secret = base64_decode($secret);
        $signature = hash_hmac('sha256' , $base64Header . '.' . $base64Payload, $secret , true);

        $base64Signature = base64_encode($signature);
        $base64Signature = str_replace(['+' , '/', '='], ['-' , '_' , ''], $base64Signature);

        //On crée le token
        $jwt = $base64Header . '.' . $base64Paylaod . '.' . $base64Signature;

        return $jwt;       

        } 

        //On vérifie la syntaxe  du token
        public function isValid(string $token): bool{

          return preg_match(
            '/^[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+$/',
            $token 
          ) === 1;  
        }

        //On récupère le Payload
        public function getPayload(string $token):array {

          //On le démonte
          $array = explode('.', $token);

          //On décode le Payload - 2 partie du payload
          $payload = json_decode(base64_decode($array[1], true));

          return $payload;  

        }

        //On vérifie si le token est expirer
        public function isExpired(string $token):bool{

          $payload = $this->getPayload($token);
          $now = new DateTimeImmutable();

          return $payload['exp'] < $now->getTimestamp();
        }

        //On récupère le Header
        public function getHeader(string $token):array {

          //On le démonte
          $array = explode('.', $token);

          //On décode le Payload - 2 partie du payload
          $header = json_decode(base64_decode($array[0], true));

          return $header;  

        }

        //On virifie la signatur du token
        public function check(string $token, string $secret){

          //On récupère le Header et le Payload
          $header = $this->getHeader($token);
          $payload = $this->getPayload($token);

          //Régénérer le token pour vérifier le token
          $verifToken = $this->generate($header,$payload,$secret, 0);

          return $token === $verifToken;
          

        }
}