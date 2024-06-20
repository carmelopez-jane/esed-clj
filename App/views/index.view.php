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
          ESED Aggregation Challenge
        </h1>
      </div>
    </header>

    <!-- Refresh call -->
    <section class="showcase relative bg-cover bg-center bg-no-repeat h-72 flex items-center">
      <div class="overlay"></div>
      <div class="container mx-auto text-center z-10">
        <h2 class="text-4xl text-white font-bold mb-4">Refresh call</h2>
        <form class="mb-4 block mx-5 md:mx-auto" action="/">
          <button class="w-full md:w-auto rounded bg-esed-2 text-esed-2 px-4 py-2 hover:bg-esed-hover">
            <i class="fa fa-search"></i> Refresh
          </button>
        </form>
      </div>
    </section>

    <section class="bg-esed text-esed py-6 text-center">
      <div class="container mx-auto">
        <h2 class="text-3xl font-semibold">List of all Pharmaceutical Products</h2>
        <p class="text-lg mt-2">
          Here you find a list of all pharmaceutical products available in our store.
        </p>
      </div>
    </section>

    <!-- All products -->
    <section>
      <div class="container mx-auto p-4 mt-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
          <?php foreach($finalResult as $result): ?>
          <div class="rounded-lg shadow-md bg-white">
            <div class="p-4">
              <h2 class="text-xl font-semibold"><?= $result['name'] ?></h2>
              <ul class="my-4 bg-gray-100 p-4 rounded">
                <li class="mb-2">
                  <strong>Path:</strong> <?= $result['path'] ?>
                </li>
                <li class="mb-2">
                  <strong>Mass:</strong> <?= $result['mass']. " ". $result['mass_unit']  ?>
                </li>
                <li class="mb-2">
                  <strong>Family:</strong> <?= $result['family'] ?>
                </li>
                <li class="mb-2">
                  <strong>User:</strong> <?= $result['user'] ?>
                </li>
              </ul>
            </div>
          </div>
          <?php endforeach; ?>
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
