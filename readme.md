# Cenere - krok pierwszy w aplikacjach webowych

Projekt został stworzony w celach doskonalenia umiejętności. Oraz jako projekt zaliczeniowy

## Getting Started

Do poprawnego uruchomienia aplikacji jest potrzebny dostęp do bazy danych. Aby taką stworzyć najlepiej użyć webscrapingu wraz z kreatorem bazy umieszczonego na https://github.com/Pozytyw/windows-cenere-database-installer

## Testy penetracyjne na stronie - błedy w trakcie tworzenie aplikacji
### Wykryte podatnosci:
#### -Mysql injection, możliwość wstrzyknięcia mysql w url parametr - załatana i przetestowana
Odwarzanie podatności:__
Commit: "mysql injection in url /clothes"__

http://localhost/clothes/?id=MTE3OQ==__
W linku powyżej znajduję się url parametr id jego wartość jest enkodowana za pomocą base64__
Dekodując wartość MTE3OQ== otrzymamy 1179. Dopisując do 1179 /* */ możemy sprawdzić czy podatność występuje, jeżeli strona wyświetli się bezbłednie oznacza to, że możememy kontynuować exploitację.
Za pomocą union select null,...,null -- możemy określić liczbę kolumn jaką otrzymujemy. Następnie zamieniamy pojedyncze nulle na jakiś ciąg znaków np 'xx' aby odnaleźć kolumnę widoczny na stronie. Finalny ciąg do encodowania i podstawienia do id "1 union select  null, "xx", "xx", null, null, null, null --".
Wypisanie wszystkich emaili wraz z hasłami:
"1 union select  null, (select GROUP_CONCAT(email) from users group by 'all' order by id), (select GROUP_CONCAT(password) from users group by 'all' order by id), null, null, null, null --"
#### -Zapisywanie w cookie wrażliwych danych takich jak email i hasło, używanych do działania "zapamiętaj" - zmiana na remeber_token
#### -Nie autoryzowany dosęp do zamówień poprzez enumerację id zamówienia. Jednak brak możliwości przypisania zamówień do użytkownika - załatana i przetestowana
