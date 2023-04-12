<?php
// src/Generator/Mail.php
namespace App\Generator;

# Получение
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Mail
{
    private $params;


    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function rand($much)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $rand = '';
        for (
            $i = 0;
            $i < $much;
            $i++
        ) {
            $rand .= $characters[rand(0, $charactersLength - 1)];
        }


        return $rand;
    }

    public function check($filename)
    {
        $file = $filename;
        $public_key = file_get_contents($this->params->get('public_key_path'));
        // проверка
        $fileData = file_get_contents($file);
        $json = fopen($file, "r");
        $json_line = fgets($json);
        fclose($json);
        $json_line = str_replace("\n", "", $json_line);


        $signature = base64_decode(substr($fileData, strpos($fileData, 'Signature: ') + 11));
        $result = openssl_verify($json_line, $signature, $public_key);


        return $result;
    }

    public function decode($filename)
    {
        $file = $filename;
        $public_key = file_get_contents($this->params->get('public_key_path'));
        // проверка
        $fileData = file_get_contents($file);
        $json = fopen($file, "r");
        $json_line = fgets($json);
        fclose($json);
        $json_line = str_replace("\n", "", $json_line);


        $signature = base64_decode(substr($fileData, strpos($fileData, 'Signature: ') + 11));

        $result = openssl_verify($json_line, $signature, $public_key);

        if ($result === 1) {
            return json_decode($json_line);
        } else {
            return false;
        }
    }

    public function creation($data)
    {
        // Создаем файл гарантийного письма 
        $time = new \DateTimeImmutable();
        $rand = $time->format('Y-m-d|H:i:s');
        $file = "GL-$rand.txt";
        file_put_contents($file, json_encode($data, JSON_FORCE_OBJECT));

        $fileData = file_get_contents($file);
        // Получаем закрытый ключ из файла
        $private_key = file_get_contents($this->params->get('private_key_path'));



        // Расшифровываем данные с помощью закрытого ключа
        openssl_sign($fileData, $signature, $private_key);

        // запись сигнатуры 
        $fileData .= "\nSignature: " . base64_encode($signature);
        file_put_contents($file, $fileData);


        return $file;
    }
}
