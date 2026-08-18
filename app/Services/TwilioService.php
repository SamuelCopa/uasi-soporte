<?php
namespace App\Services;

use App\Models\Configuracion;
use Twilio\Rest\Client;

class TwilioService
{
    private $accountSid;
    private $authToken;
    private $whatsappNumber;

    public function __construct()
    {
        $this->accountSid = Configuracion::where('clave', 'twilio_account_sid')->first()->valor;
        $this->authToken = Configuracion::where('clave', 'twilio_auth_token')->first()->valor;
        $this->whatsappNumber = Configuracion::where('clave', 'twilio_whatsapp_number')->first()->valor;
    }

    public function getClient()
    {
        return new Client($this->accountSid, $this->authToken);
    }

    public function getWhatsappNumber()
    {
        return $this->whatsappNumber;
    }

    public function sendMessage($to, $message)
    {
        $client = $this->getClient();
        $client->messages
            ->create("whatsapp:$to", [
                'from' => "whatsapp:" . $this->whatsappNumber,
                'body' => $message,
            ]);
    }
}

?>
