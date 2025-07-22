
  # Clonación del repositorio.
  ~~~bash  
   git clone https://github.com/Rrosso27/prueba-tecnica-smartSoluctions-app.git
  ~~~
  # Crear Base de datos    
  Antes de empezar crea una base de de datos, con el nombre de:
  ~~~bash  
    prueba_tecnica_smart_soluctions_app
  ~~~
  Este nombre es opcional, pero si decides cambiarlo, recuerda actualizarlo también en el archivo .nev.

  ## Crear el .env 
  Para crear el archivo .env, debes hacer una copia de [.env.example ](https://github.com/Rrosso27/prueba-tecnica-smartSoluctions-app/blob/main/.env.example) y renombrarla como .env

  ## Instalar las dependencias del composer    
  Para instalar las dependencias de Composer, debes tener  [Composer ](https://getcomposer.org/) previamente instalado en tu equipo y ejecuta este comando para instalar la dependencias  
  ~~~bash  
    composer install
  ~~~

  ## Ejecutar las migraciones   
  Las migraciones permiten gestionar nuestra base de datos de manera más eficiente, facilitando el control y el versionamiento de sus cambios. Para ejecutarlas, utiliza el siguiente comando:  
  ~~~bash  
      php artisan migrate
  ~~~

  ## Ejecutar los seeders 
  Los seeders permiten insertar datos por defecto en la base de datos. En este caso, se utilizan para generar una encuesta inicial que facilita la interacción con el sistema. Para ejecutar los seeders, utiliza el siguiente comando:
  ~~~bash  
      php artisan db:seed
  ~~~
  ## Ejecutar el servicio   🚀  
  Para ejecutar el servicio, asegúrate de que todos los requisitos estén cumplidos y utiliza el comando adecuado.
  ~~~bash  
      php artisan serve
  ~~~
