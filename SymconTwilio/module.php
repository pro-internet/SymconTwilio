<?

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

            echo __DIR__;

        }

 
        public function ApplyChanges() {
            parent::ApplyChanges();
        }

        public function Destroy () {

            parent::Destroy();

        }


    }


?>