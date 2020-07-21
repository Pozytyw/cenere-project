# Cenere - krok pierwszy w aplikacjach webowych

Projekt został stworzony w celach doskonalenia umiejętności. Oraz jako projekt zaliczeniowy

## Getting Started

Do poprawnego uruchomienia aplikacji jest potrzebny dostęp do bazy danych. Aby taką stworzyć najlepiej użyć webscrapingu wraz z kreatorem bazy umieszczonego na https://github.com/Pozytyw/windows-cenere-database-installer

## Testy penetracyjne na stronie - błedy w trakcie tworzenie aplikacji
### Wykryte podatnosci:
#### mysql injection, możliwość wstrzyknięcia mysql w url parametr - załatana i przetestowana

#### zapisywanie w cookie wrażliwych danych takich jak email i hasło, używanych do działania "zapamiętaj" - zmiana na remeber_token
#### nie autoryzowany dosęp do zamówień poprzez enumerację id zamówienia. Jednak brak możliwości przypisania zamówień do użytkownika - załatana i przetestowana
