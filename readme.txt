=== Co-marquage service-public.fr ===
Contributors: seb-emendo, denizemendo
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Tags: comarquage, co-marquage, service public, service-public, service, public, gov, kienso, demarche, guide
Requires at least: 6.0
Tested up to: 6.6

Link to the French government service (co-marquage): service-public.fr

== Description ==

**Attention :** ce plugin n’est plus maintenu. [Plus d’informations](https://www.baseo.io/plugins/comarquage-service-public-wordpress/?utm_source=anc-plugin&utm_campaign=readme).

Ce plugin permet d'intégrer les pages d'informations de service-public.fr directement dans votre site Internet.
Vous disposez ainsi du co-marquage service-public.fr pour votre site Internet sous Wordpress.<br>
<br>Ce plugin est conçu spécifiquement pour les collectivités territoriales française.
Agence Web [Kienso](https://www.kienso.fr/) a développé ce plugin dans le cadre de projets réalisés pour des collectivités. Nous en assurons aujourd'hui la maintenance et le mettons à disposition.

### Fonctionnement
* Copie les données provenant de service-public.fr dans votre espace web
* Vérifie toutes les 24 heures s'il existe une mise à jour des données de service-public.fr
* Affiche de façon formaté les données de service-public.fr (voir les [captures d'écran](#screenshots) )
* Permet l'affichage des établissements locaux

#### Afficher une page de sommaire
Un simple shortcode permet d'afficher la "page de sommaire" pour les particuliers, associations ou les entreprises.<br>
A partir de cette page de sommaire le visiteur navigue pour trouver la démarche recherchée.
* Créer votre page (ex : Guide des démarches pour les particuliers)
* Insérez le code court (shortcode) : [comarquage category='part']
* Selectionnez cette page comme "page sommaire" depuis les réglages du plugin (Réglages -> Co-marquage SP)

#### Une fiche en particulier
Par exemple pour la fiche "Mise à jour du Livret de famille" (qui concerne donc les particuliers),
que l'on trouve à l'url suivante sur service public : https://www.service-public.fr/particuliers/vosdroits/F18910<br>
Vous utiliserez le code court suivant : [comarquage category='part' xml='F18910']

#### Etablissements locaux & Téléservices
En fonction du sujet (carte d'identité, assurance, ...), l'internaute est dirigé vers les établissements locaux (mairie, tribunal, service des impôts, ...) ou vers les services en ligne correspondant.

### Signaler un Bug
Vous pouvez signaler un bug ou proposer une amélioration depuis l'onglet support.

== Installation ==

- Copiez ce plugin dans votre dossier de plugins (wp-content/plugins/)
- Activez le depuis l'interface d'administration de wordpress : sous le menu "Extensions"
- Aller ensuite dans les réglages pour préciser les informations sur votre commune (Département, code INSEE, ...)
- Il vous faut ensuite ajouter le shortcode dans la page qui affichera le guide. ex :
    [comarquage category='part'].
<br>categorie disponible : part, pro ou asso

Pour des questions graphique et de visibilité, nous conseillons l'affichage dans un template de page sans colonne latérale.

== Changelog ==
= 0.5.76 =
Release Date: 2024-10-24
* Fix bug on missing class Notices

= 0.5.75 =
Release Date: 2024-10-23
* Add an outdated message for the plugin

= 0.5.74 =
Release Date: 2024-04-16
* Add a unmaintained message for the plugin

= 0.5.73 =
Release Date: 2024-02-23
* Fix Cross Scripting on search
* Change zip download links

= 0.5.72 =
Release Date: 2023-12-06
* Fix Cross Scripting on shortcode
* Fix strftime deprecated
* Fix Home for Pro and Asso

= 0.5.71 =
Release Date: 2023-04-24
* Fix a bug on Particulier Home page

= 0.5.70 =
Release Date: 2023-03-16
* Change XML files updater algorithm

= 0.5.64 =
Release Date: 2022-09-13

Bugfixes:

* Fix image display without caption or description

= 0.5.63 =
Release Date: 2022-09-06
* Minor bugfix

= 0.5.62 =
Release Date: 2022-09-06
* Bugfixes:
	* Adding a missing tag template

= 0.5.61 =
Release Date: 2022-06-15
* Fix some css
* Test with wordpress 6.0
* Remove a credit link

= 0.5.60 =
Release Date: 2021-07-01
* Fix a bug on "Marchés publics" link for company

= 0.5.59 =
Release Date: 2021-03-05
* Fix a bug on slide on "Services en ligne et formulaires"

= 0.5.58 =
Release Date: 2021-01-25
* Fix files content after error on git push

= 0.5.57 =
Release Date: 2021-01-20
* Clean and fix bug for slide block
* prefix data- attributes to data-co-
* modify css reset

= 0.5.56 =
Release Date: 2020-09-10
* Clean and fix bug in search

= 0.5.55 =
Release Date: 2020-09-09
* Bugfixes:
	* on comarquage directory creation

= 0.5.54 =
Release Date: 2020-08-20
* Bugfixes:
	* Activate error on install check

= 0.5.53 =
Release Date: 2020-08-20
* Code rewrite
* Bugfixes:
	* Service Public Certificate verify problem

= 0.5.52 =
Release Date: 2020-04-17
* Bugfixes:
	* Rechange root file name. Broke update

= 0.5.51 =
Release Date: 2020-04-17
* Update:
	* CSS styles
* Bugfixes:
	* Leaflet map layer no longer available. Change to CartoDB

= 0.5.5 =
Release Date: 2019-07-04
* Update:
	* CSS styles
* Bugfixes:
	* Leaflet display in tab
* Enhancements:
	* New shortcode to display one page
	* Set the root pages in configuration
	* Add ZipArchive require on activate
	* Template modification to pass RGAA 3.0

= 0.5.4 =
Release Date: 2019-01-29
* Update:
	* Leaflet to 1.4.0

= 0.5.3 =
Release Date: 2018-12-21
* Bugfixes:
	* jQuery Handle
	* Leafletjs call when not load

= 0.5.2 =
Release Date: 2018-12-05
* Enhancements:
	* Replace Google Map with OpenStreetMap / LeafletJS
	* Test compatibility with Wordpress 5.0
	* some CSS
* Bugfixes:
	* XML Load create Fatal Error on UpdateZip

= 0.5.1 =
Release Date: 2018-02-05
* Enhancements:
	* New flow version from service public
	* Change templating process
	* Change design (icons, css, ... )
	* Remove fontawesome

= 0.4.6 =
Release Date: 2017-07-21
* Bugfixes:
	* error 500 on google map js loading

= 0.4.5 =
Release Date: 2017-07-18
* Bugfixes:
	* Encoding errors fix. Convert xsl from ISO-8859-15 to UTF-8

= 0.4.4 =
Release Date: 2017-07-17

* Bugfixes:
	* 404 errors or redirection to home page
* Enhancements:
	* change path and url contruction
	* proxy support (cogitis contrib)
	* more plugins options (disable css or js load)
	* could add Google map api key
	* prepare for the next version
	* change unzip methode to php standard instead of wordpress Filesystem library function (hpeldin contrib)

= 0.4.3 =
Release Date: 2016-02-05
* Enhance : new search engine (less memory usage)

= 0.4.2 =
Release Date: 2015-12-30

* Bugfixes:
	* SSL Certificate : certificate verify failed for local information

= 0.4.1 =
Release Date: 2015-12-29

* Bugfixes:
	* SSL Certificate : certificate verify failed

= 0.4.0 =
Release Date: 2015-11-23

* Bugfixes:
	* Fixe some CSS issu
	* Fixe test on frontend / alert
	* Fixe errors on activate
	* Fixe unsaved options in settings page
* Enhancements:
	* Add a install checkup before enable plugin
	* Error management during file transfert
	* Change sidebar block header. Remove h3 headings from list
	* Use HTTPS link for service-public data download
	* Enhance settings page in the admin

= 0.3.9 =
Release Date: 2015-11-09

* Bugfixes:
	* Fixes error on plugin manual activate

= 0.3.8 =
Release Date: 2015-11-09

* Bugfixes:
	* Fixes CSS problem with bootstrap theme
	* Fixes XML directory delete bug
	* Updated the minimum required version of WordPress to 4.0.

* Improve :
	* CSS
	* Modification in XSL format (v3 compatibility)
	* Prepare the update for v3 flow

= 0.3.7 =
Release Date: 2015-06-03

* First release publish on wordpress repository


== Screenshots ==

1. Sommaire d’accueil
2. Exemple d’une page de guide pour une démarche
3. Exemple de localisation
4. Page de réglages dans l'admin
