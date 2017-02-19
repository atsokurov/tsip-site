# tsip-oms
Сайт для дисциплины "Технологии создания Интернет-приложений"

# Компоненты сайта
CrDatabase            - PDO драйвер для связи с базой данных MySQL  
CrErrorDispatcher     - Статичный класс для отслеживания и логгирования ошибок в работе сайта
CrTemplate            - Шаблонизатор модулей. Под модулем в данном случае подразумевается отдельный блок сайта: информационный div, отдельный span и т.д.
CrPage                - Шаблонизатор всего сайта. Использует шаблонизатор модулей для рендеринга всей страницы сайта.

# Управляющие элементы сайта
index.php          - Главная страница  
init.php           - Скрипт, подгружающий базовые компоненты сайта
register.php       - Регистрация пользователя в системе
login.php          - Вход пользователя в систему
logout.php         - Выход пользователя из системы
rest.php           - REST компонент для операций SELECT, INSERT, UPDATE и DELETE над базой данных
userpage.php       - Личный кабинет пользователя
accounts.php       - Список банковских аккаунтов пользователя 
account-create.php - Регистрация новой банковской карты
