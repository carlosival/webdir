Para enviar los mensajes en el servidor implemntar un cron con el siguiente comando.

app/console swiftmailer:spool:send --message-limit=50 --env=prod > /dev/null 2>>app/logs/mail_error.log

donde --message-limit=50 significa enviar en lotes de 50