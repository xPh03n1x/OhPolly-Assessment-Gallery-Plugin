
QuickShop by ohPolly
===================
QuickShop is a module for Magento **1** that allows you to create a gallery of images, with links to different URLs.
With it you can quickly create a single page referring to products from different stores to benefit from referral programs.

----------
Installation
------------
To install the module in your Magento 1 instance, you can directly checkout the repository to your document root.

Once the files are placed within your Magento, access your admin panel and head to the configuration page: *System* -> *Configuration* -> *QuickShop Gallery*

On this page you should pick:

 - the title of the Front End page
 - whether Magento's Breadcrumbs be displayed on the Front End page
 - how many gallery items you want displayed per row
 - the total amount of items you want to be displayed *per page*

----------

Usage
-----
The front end of the gallery is accessible through the url **/quickshop/**.

    http://www.mystore.com/quickshop/


To start adding items to the gallery, head to the **QuickShop** page, situated under the **CMS** tab of your Magento admin panel.

This page gives a list of all Gallery items you have in your store.

To add a new item, click on the button "*Add New Image*" situated in the top right of the page. From here you just have to chose the image file you want to upload, and the target URL the image should lead to.

From this same page you can also modify or delete gallery items.


*Note*
> You can remove multiple entries at once by selecting the images you want removed, and then using the option under "Actions"

If you want to set the page as the Homepage for your website, go to:

*System* -> *Configuration* -> *General* -> *Web* -> *Default Pages*

and define as **Default Web URL** the module handler:

> quickshop

----------