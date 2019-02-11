========================================================
	Aplicatie Social-Media cu poze
		--proiect web--
========================================================

 ________________________________________

	Functionalitatea proiectului												
 ________________________________________
		
		--> aplicatia este conectata la o baza de date mysql local prin phpmyAdmin, unde sunt stocate toate datele si pozele postate de fiecare utilizator
		
		--> aplicatia se conecteaza la serverul local (localhost) pentru a putea rula in browserul de internet
		
		--> utilizatorul acestei aplicatii isi poate crea un cont si poate sa isi seteze avatarul pentru contul creat. In cazul in care emailul sau username-ul apar deja
		    in baza de date, utilizatorul nu mai poate folosi acele date pentru a crea un cont nou.
		
		--> contul creat in formularul de inregistrari este scris in baza de date prin intermediul registerForm-ului. Accesta extrage toate datele din formularul de inregistrare
		    si le pune intr-un INSERT query de SQL.

		--> odata creat un cont si inregistrat in baza de date, utilizatorul se poate autentifica pentru a accesa mainApp-ul acestui proiect. In cazul in care utilizatorul
		    a gresit username-ul sau parola, acesta este anuntat de un mesaj ce apare sub formularul de completat. Acest lucru se intampla si in cazul in care utilizatorul
		    greseste ConfirmPassword din registerForm
		
		--> mainApp-ul contine o pagina web in care utilizatorul poate vedea toate pozele adaugate de cei care folosesc aplicatia respectiva, numarul de like-uri
		    pe care utilizatorii il au la pozele postate, toate comentariile pe care diferitii useri le-au lasat la diferite poze, un buton de like sau unlike(dupa caz),
		    un textbox pentru ca utilizatorul sa poata posta un comentariu la poza si un buton de postare a comentariului. Aplicatia marcheaza vizual faptul ca utilizatorul
		    a dat "like" la o poza. In momentul in care utilizatorul da "unlike" la o poza, acest lucru este de asemenea marcat(inima se face neagra). De asemenea in pagina mainApp-ului
		    mai gasim si poza de profil a utilizatorului logat si un buton de adaugare imagini. In momentul in care se face hoover pe imaginea de profil a utilizatorului, apare un pop-up menu
		    pentru log-out(deconecteaza utilizatorul curent si il redirecteaza catre fereastra de login) si butonul "myPictures" care redirecteaza userul la o pagina in care se gasesc toate imaginile
		    incarcate de acesta, sortate in ordinea datei postarii. Din aceasta pagina, utilizatorul poate sa stearga poze, iar acest lucru determina actualizarea bazei de date.

__________________________________________________________________________
	
	Pentru realizarea acestui proiect am folosit : HTML,CSS,PHP,XAMPP
	-> printurile sunt facute pe o distributie de Ubuntu
__________________________________________________________________________
		
		! consultati pozele pentru a avea o mica idee despre style-ul aplicatiei.
