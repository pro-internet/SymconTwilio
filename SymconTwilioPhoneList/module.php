<?


    // Klassendefinition
    class SymconTwilioPhoneList extends IPSModule {
 
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


           $this->RegisterPropertyInteger("twilioInstance", 0);
           $this->RegisterPropertyString("numbers", "");
 
        }

        public function Call() {

            $ok = $this->IsConfigured();

            if ($ok) {

                $twilioInstanceId = $this->ReadPropertyInteger("twilioInstance");

                $numbers = $this->ReadPropertyString("numbers");
                $numbersArray = json_decode($numbers);
                $caller = $this->ReadPropertyString("twilionumber");
                $client = Twilio_GetClient($twilioInstanceId);

                $completed = false;

                foreach ($numbersArray as $number) {

                    if (!$completed) {
                        echo $number->name . " wird angerufen... \n";
                        $call = $client->calls->create($number->number, $caller, array("url" => "http://demo.twilio.com/docs/voice.xml"));
                        Sleep(30);
    
                        $result = file_get_contents("https://api.twilio.com" . $call->uri);

                        if ($result->status == "completed") {
                            $completed = true;
                            echo $number->name . " hat abgenommen! \n";
                        } else {
                            echo $number->name . " hat nicht abgenommen. \n";
                        }

                    }

                }

            } else {

                echo "SymconTwilioPhoneList ist nicht konfiguriert!";

            }

        }

        private function IsConfigured() {

            $twilioInstance = $this->ReadPropertyInteger("twilioInstance");
            $numbers = $this->ReadPropertyString("numbers");
            $caller = $this->ReadPropertyString("twilionumber");

            if ($twilioInstance != 0 && $numbers != "" && $caller != "" ) {

                $modExists = IPS_InstanceExists($twilioInstance);

                if ($modExists) {

                    $mod = IPS_GetInstance($twilioInstance)["ModuleInfo"]["ModuleID"];

                    if ($mod == "{c705e77a-fc31-4e30-8b86-7b14aaec6767}") {

                        return true;

                    } else {

                        echo "Die angegebene Instanz ist keine Twilio Instanz!";
                        return false;

                    }

                }

            }

            return false;


        }

 
        public function ApplyChanges() {
            parent::ApplyChanges();
        }

        public function Destroy () {

            parent::Destroy();

        }


    }


?>