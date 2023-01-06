<?php

namespace App\Http\Controllers\Knihy;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Orders;
use App\Books;

class KnihyController extends Controller
{
    function index(Books $books) {
        $books = $books->all();

    	return view('knihy.knihy', compact('books'));
    }

    function paypalPayment(Request $request) {
    	//dd($request);

    	$orders = new Orders($request->all());
    	$orders->save();
    	return json_encode(array('state' => 1));
        exit;
    }

    function paymentEmail (Request $request) {
$hlavicka = 'From: info@kerouac.cz' . "\n";
$hlavicka .= 'MIME-Version: 1.0' . "\n"; 
$hlavicka .= 'Content-type: text/html; charset=UTF-8' . "\n"; 
$hlavicka .= 'Content-Transfer-Encoding: 8bit' . "\n";

            $name = $request->forename;
            $email = $request->email;
            $message = 
"<p>Dobrý den,\n\n<br></p>

<p><strong>Vaše objednávka proběhla úspěšně.</strong><br></p>\n\n

<p>Knihy očekávejte do několika pracovních dnů. V případě pozdějšího dodání prosíme o přihlédnutí k domácí přípravě balíků a zároveň se za případné zpoždění omlouváme.<br></p>\n\n

<p>V případě jakýchkoli chyb či nespokojenosti se neváhejte obrátit na tento e-mail či facebook.<br><br><br></p>\n\n

<p>Děkujeme za Vaši přízeň a mějte se krásně,<br><br>\n\n
tým Slavné literární skupiny Kerouac</p>

<p><a href='mailto:info@kerouac.cz'>info@kerouac.cz</a><br>\n\n
<a href='http://kerouac.cz'>http://kerouac.cz</a><br>\n\n
<a href='http://thefamousliterarygroup.co.uk'>http://thefamousliterarygroup.co.uk</a>";

        //send email
            mail($email, 
                "Potvrzení objednávky ze serveru Kerouac.cz", 
                $message,
                $hlavicka);
    }
}
