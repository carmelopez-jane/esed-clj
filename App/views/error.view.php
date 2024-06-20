<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /><link rel="stylesheet" href="css/style.css" />
    <title>ESED Challenge</title>
  </head>
  <body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-esed text-esed p-4 text-center">
      <div class="container mx-auto">
        <h1 class="text-3xl font-semibold">
          <a href="index.html">ESED Aggregation Challenge</a>
        </h1>
      </div>
    </header>

    <!-- Refresh call -->
    <section class="showcase relative bg-cover bg-center bg-no-repeat h-72 flex items-center">
      <div class="overlay"></div>
      <div class="container mx-auto text-center z-10">

      </div>
    </section>
    <section>
      <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3"><?= $status ?></div>
        <p class="text-center text-2xl mb-4">
          <?= $message ?>
        </p>
        <a class="block text-center hover:underline" href="/">Go Back To List of products</a>
      </div>
    </section>
      <!-- Footer -->
    <section class="container mx-auto my-6 text-center">
      <div class="bg-esed text-white rounded p-4">
        <p class="text-gray-200 text-lg mt-2">
            ESED Aggregation Challenge Carme López Jané
        </p>
      </div>
    </section>
  </body>
</html>
