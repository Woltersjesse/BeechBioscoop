# BeechBioscoop

# De opdracht

Ontwikkel een reserveringssysteem voor onze Beech bioscoop waar gebruikers stoelen
kunnen reserveren. Stoelen kunnen afhankelijk van de beschikbaarheid worden
toegewezen, en het systeem moet met toekomstige uitbreidingen kunnen omgaan
(zoals groepsreserveringen, opmerkingen en loyaliteit punten).

# Junior level

## 1:Gebruik het singleton pattern om de databaseverbinding te beheren.

## 2:Gebruik het factory pattern voor het aanmaken van verschillende

soorten stoelen (bijvoorbeeld standaardstoel, luxe stoel, rolstoelplek)

# Medior level

## 1:Breid het systeem uit met ondersteuning voor verschillende

schermgroottes en indelingen door gebruik te maken van het strategy
pattern

Ik zou een max van 4 breakpoints maken in de css die dit regelen.

## 2:Implementeer een notificatiesysteem dat gebruikers waarschuwt over

hun reservering via SMS of e-mail. Gebruik hiervoor het observer
pattern.

Ik zou een functie implementeren die 24 uur voor het starten van de film een email/sms
stuurt naar alle email adressen/telefoonnummers die gekoppeld staan aan het account
van de reservatie.  
Een observer zal een check krijgen 24 uur voor het starten van de film om alle users een
notificatie te sturen dat hun film start over 24 uur ter herinnering.
De film krijgt zijn eigen array aan gebruikers wanneer een reservatie is gemaakt zodat de
functie later wanneer het tijd is om een notificatie te sturen eenvoudig met een foreach
loop alle gebruikers een bericht kan sturen over de reservatie.
En zodra de film geweest is wordt de array leeggehaald zodat gebruikers geen extra emails ontvangen

- Stap 1 controleer of het 24 uur voor start tijd is.
- Stap 2 stuur een bericht naar de gebruikers via email/sms (een gebruiker moet een
  email hebben voor het aanmaken van een account maar een reservatie kan ook
  gemaakt worden op basis van een telefoonnummer. Alleen gebruikers met een geldig
  email adres en account kunnen loyaliteit punten verdienen)
- Stap 3 maak de array leeg zodat gebruikers geen dubbele e-mails/sms ontvangen

# Senior level

## 1:Zorg ervoor dat de stoelreserveringen schaalbaar zijn door het

command pattern toe te passen voor acties zoals reserveren,
annuleren en wijzigen.

## 2: Implementeer een caching-mechanisme om de beschikbaarheid van

stoelen efficiënter te controleren. Maak gebruik van het decorator
pattern om de cache dynamisch toe te voegen aan de stoeldatabase
