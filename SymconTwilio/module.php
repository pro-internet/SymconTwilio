<?

    require_once __DIR__ . "/autoload.php";
    
    use Twilio\Rest\Client;

    // Klassendefinition
    class SymconTwilio extends IPSModule {
 
        // Der Konstruktor des Moduls
        // Überschreibt den Standard Kontruktor von IPS
        public function __construct($InstanceID) {
            // Diese Zeile nicht löschen
            parent::__construct($InstanceID);

            // Selbsterstellter Code
        }
 
        // Überschreibt die interne IPS_Create($id) Funktion
        public function Create() {

            parent::Create();


           $this->RegisterPropertyString("sid", "");
           $this->RegisterPropertyString("token", "");
 
        }

        public function GetClient() {

            $sid = $this->ReadPropertyString("sid");
            $token = $this->ReadPropertyString("token");

            if ($sid == "" || $token == "") {
                echo "Kann Client nicht erstellen: SID oder Token fehlen!";
                return;
            }

            $client = new Client($sid, $token);
            return $client;

        }

 
        public function ApplyChanges() {
            parent::ApplyChanges();
        }

        public function Destroy () {

            parent::Destroy();

        }


    }


?>