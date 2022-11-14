
<h1>Hello</h1>
<h2>Установка ПО</h2>
<ul>
    <li>Apache - web server for PHP</li>
    <li>PHP interpritator</li>
    <li>Настраеваем Apache на скачанній PHP</li>
    <li>Млм устанавливаем сборку ХАМРР</li>
</ul>
<h2>Настройка ркпужения</h2>
<ul>
    <li>Простой вариант - назодим папку htdocs (/xampp), удаляем
        из нее все содержимое и заменяем на свой проект.
        проект будет доступен при включенном Apache по адресу
        localhost
    </li>
    <li>Более сложный вариант</li>
    <ul>
        <li>Откріваем файл конфигурации Apache httpd-vhosts.conf
            (apache/conf/extra), создаем в нем определение для
            виртуального хоста используя закоментированные 
            примеры. Указываем расположение новой папки проекта 
        </li>
        <li>
            Создаем для проекта доменное имя (phpsite.local),
            указываем его в конфигурации, а также вносим в 
            локальную службу DNS C:\Windows\System32\drivers\etc
            также расскоментируя примері
        </li>
    </ul>
</ul>
<!-- hhtpd-vhosts.conf
C:\xampp\apache\conf\extra
C:\Windows\System32\drivers\etc -->
