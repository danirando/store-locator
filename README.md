# 📍 Laravel Store Locator (Livewire + Leaflet)

Una moderna applicazione di localizzazione punti vendita costruita con **Laravel**, **Livewire 3** e **Leaflet.js**. L'interfaccia offre una lista interattiva di negozi sincronizzata in tempo reale con una mappa interattiva.

## 🚀 Caratteristiche
- **Mappa Interattiva**: Integrazione con Leaflet.js e OpenStreetMap.
- **Lista Scrollabile**: Sidebar con elenco dei negozi con scroll verticale indipendente (altezza fissa `80vh`).
- **Sincronizzazione Click**: Cliccando su un negozio nella lista, la mappa si sposta e zooma automaticamente sulla posizione selezionata.
- **Design Responsive**: Layout flessibile realizzato con Tailwind CSS.
- **Dark Mode Ready**: Supporto completo per il tema scuro.

## 🔐 Amministrazione e Gestione Dati
Il progetto include un'area protetta accessibile solo agli utenti con privilegi di **Admin**. In questa sezione è disponibile un tool di importazione che permette di:
1. Caricare file **CSV** con i dati degli store (nome, indirizzo, coordinate, ecc.).
2. Validare i dati prima del salvataggio nel database.
3. Aggiornare rapidamente la rete dei punti vendita senza interventi manuali nel codice.

## 🛠️ Tech Stack
- **Backend**: Laravel 12
- **Frontend**: Livewire 3, Tailwind CSS
- **Mappe**: Leaflet.js (OpenStreetMap)
- **Database**: PostgreSQL