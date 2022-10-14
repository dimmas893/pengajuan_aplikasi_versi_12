<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class SendMailController extends Controller
{
    public function index()
    {
        return view('email');
    }

    public function store(Request $request)
    {
        // $tes = $request->tes;
        // require '..\vendor/autoload.php';
        // $mail = new PHPMailer(true);
        // $mail->SMTPDebug = 0;
        // $mail->isSMTP();
        // $mail->Host = env('EMAIL_HOST');
        // $mail->SMTPAuth = true;
        // $mail->Username = env('EMAIL_USERNAME') ;
        // $mail->Password = env('EMAIL_PASSWORD');
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->Port = 587;
        // $mail->setFrom($tes, 'name');
        // $mail->addAddress('testing.paboi@gmail.com');
        // $mail->isHTML(true);
        // $mail->Subject = 'subject';
        // $mail->Body = 'body';
        // $dt = $mail->send();

        // if($dt){
        //     return 'berhasil';
        // }else{
        //     return 'gagal';
        // }
        $category = Category::all();


        $message = view('email', compact('category'))->render();
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mail.ourproduct.id';
            $mail->SMTPAuth = true;
            $mail->Username = 'tester@ourproduct.id';
            $mail->Password = 'j@x@gptu3@Dg';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom("anandadimmas@anandadimmas.my.id", "test");
            $mail->addAddress("anandadimmas1204@gmail.com");
            $mail->isHTML(true);
            $mail->Subject = 'subject';
            // $jsonNilai = array();
            // foreach ($category as $p) {
            //     $row =  $p->name;
            //     array_push($jsonNilai, $row);
            // }
            $mail->Body    = $message;
    $mail->send();

} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
    }
}
