## API do prostego bloga

Funkcjonalności do zaimplementowania:
1. Prosta rejestracja przez stronę serwisu(nie korzystamy z make:auth).
   - Rejestracja powinna zawierać:
   - imię użytkownika (3-15 znakow)
   - mail
   - hasło (minium 8 znakow)

   Powinna być możliwość zresetowania hasła. Defaultowo użytkownik zostaje zarejestrowany z rolą “Użytkownik”. Maile wysyłamy w tle za pomocą kolejki.
2. Listowanie postów na stronie głównej z paginacją wpisów po 10 / strona
3. Logowanie do panelu po emailu/haśle tylko dla kont oznaczonych jako Redaktor/Administrator.
4. W panelu po zalogowaniu:
   - Redaktor:
     - listowanie postów
     - dodawanie postów (upload plików graficznych)
     - edycja postów
     - usuwanie postów
   - Administrator (to samo co Redaktor oraz):
     - listowanie użytkowników
     - dodawanie/edycja/usuwanie + nadawanie roli Użytkownik/Redaktor/Administrator

Proszę pamiętać o trzymaniu standardów PSR. Mile widziane napisanie testów - nie jest to jednak wymagane. Miło będzie jeśli wiesz co to i będziesz stosować: SOLID/KISS/DRY/YAGNI
Oczekujemy skorzystania z:
- FormRequests
- Events
- Jobs
- Repository pattern
