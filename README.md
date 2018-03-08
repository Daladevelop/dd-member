# dd-member
Daladevelops egna medlemssystem

Målet är att få ett stabilt och praktiskt medlemssystem för att använda mot våra medlemmar. 
Det ska kunna hantera och automatisera flera av processerna vi annars gör manuellt. 

Saker som finns:
* medlemsförteckning

Saker vi vill ha:
* Kunna skapa grupper och lägga till medlemmar i grupperna
* Kunna skapa mail och skicka till medlemmar / grupper
* Kunna skicka sms?
* Kunna ha översikt över inbetalningar av medlemsavgift
* kunna skicka ut påminnelser om att betala medlemsavgiften
* ta betalt direkt i systemet? 'autogiro' ?
* (eventuellt) kunna ta ut fil över inbetalda medlemsavgifter för import i andra system


Helper functions
\App\Helpers\Helper::message($title,$content,$type)
genererar ett meddelande i toppen. type ska vara bootstrap typ, success, danger, warning etc