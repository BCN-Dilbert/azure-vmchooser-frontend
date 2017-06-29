<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h2>About</h2>
<p>"VMchooser" was created by <a href="https://about.kvaes.be/" target="_blank">Karim Vaes</a> to aid anyone in a quest to find the right VM size in Azure.</p>
<p>Both the <a href="https://github.com/kvaes/azure-vmchooser-frontend" target="_blank">frontend</a> and <a href="https://github.com/kvaes/azure-vmchooser-backend" target="_blank">backend</a> are hosted on Github for the curious people out there. ;-)</p>
<p>The architecture behind the web page heavily relies on Azure App Service (Web App), Azure Functions, Azure Logic Apps & Azure Blob Storage. The frontend serves the pages and will query the API (Azure Functions) directly for the search, or store the CSV file onto a storage account. The CSV file will be picked up on the storage by a Logic App. This will do the necessary steps, where a Azure Functions will be a key component once again.</p>