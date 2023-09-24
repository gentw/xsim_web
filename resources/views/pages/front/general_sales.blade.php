@extends('layouts.app')

@if(!empty($page_content))
    @section('content')
        {!! $page_content !!}
    @endsection
@else
    @section('banner')
    <section class="banner general-sales-banner">
        <div class="container">
            <div class="desc">
                <h1>General Sales Conditions</h1>
                <p>General terms of sale and delivery <br>The present general terms of sale define the contractual relationship:</p>
                <p>BETWEEN:</p>
                <p>EGRAPHIC DMCC,</p>
                <p>Corporation with the capital of CHF500'000, whose head office is located in CH-2720 Tramelan, Switzerland, registered at the Trade register of the canton of Berne under the number CH-073.3.016.481-2, on behalf of www.xxsim.com, the website for XXSIM products,</p>
                <p>ON THE ONE HAND,</p>
                <p>AND</p>
                <p>Any natural or legal person visiting or carrying out a purchase on the site for him-/herself or a third party, hereafter called “the Customer”;</p>
                <p>ON THE OTHER HAND.</p>
            </div>
        </div>
    </section>
    @endsection

    @section('content')
    <main>
        <section class="terms-condition-section">                    
            <div class="gray-bg">
                <div class="container">
                    <h2 class="titleh3">Field of application</h2>
                    <p>The conditions apply to all the contracts of product sales by EGRAPHIC DMCC with the customers. The conditions exclude all other conditions except contrary conventions written by EGRAPHIC DMCC. Any order of products is regarded as an offer of the customer to buy such products in accordance with the conditions. EGRAPHIC DMCC accepts the purchase offer of the customer according to the conditions by emitting a confirmation of order to the customer. The customer must check the confirmation of order and immediately warn EGRAPHIC DMCC if it detects an error, in the absence of what, EGRAPHIC DMCC will deliver the product in accordance with the order confirmation which will be taken.</p>
                </div>
            </div> 
            <div>
                <div class="container">
                    <h2 class="titleh3">Conditions:</h2>
                    <p>Business between EGRAPHIC DMCC and the customer are managed exclusively by the delivery terms hereafter. The general terms are presented in three languages, the French version is taken in the event of difference of contents or interpretation.</p>
                </div>
            </div> 
            <div class="gray-bg">
                <div class="container">
                    <h3>Delivery:</h3>
                    <p>Products of the website are delivered after reception of the payment. It is necessary to roughly count 1 to 2 days for Switzerland and roughly 2 to 5 days for the rest of the world. EGRAPHIC DMCC can not be held responsible for the delays of delivery and does not confirm any time. The product is sent by simple post, without insurance.</p>
                </div>
            </div> 
            <div>
                <div class="container">
                    <h3>Features/modifications</h3>
                    <p>The customer is itself responsible him-/herself for the use of the products. All technical information, data and dimensions do not constitute a guarantee of EGRAPHIC DMCC concerning of the specific properties. EGRAPHIC DMCC does not take any responsibility for the possible transmission and printing errors. This is valid in particular for the consecutive damage and the resulting costs.</p>
                </div>
            </div>
            <div class="gray-bg">
                <div class="container">
                    <h3>Price:</h3>
                    <p>All the prices are indicated in euros. They are posted without VAT. The delivery charges are included in the selling price. All our articles are sold within the limit of stocks available and we reserve the right to limit the ordered quantities.</p>
                </div>
            </div> 
            <div>
                <div class="container">
                    <h3>Payment:</h3>
                    <p>In the event of sale on invoice, all our prices are calculated Net. Our invoices must thus be paid without any delay. In the event of non-observance of this deadline for payment, our company has the right to take an interest arrears of 7%.</p>
                </div>
            </div>
            <div class="gray-bg">
                <div class="container">
                    <h3>Guarantee:</h3>
                    <p>Except contrary stipulation, the guarantee relating to all the offered products on the website is 12 months. The invoice and the date of invoicing are taken as guarantee. A copy of invoice will have to accompany each return of defective material. Excluded of the liability are the damages rising from a modification or a repair by the customer, or making following wear, an emergency like with the non-observance of the instructions of service.</p>
                </div>
            </div> 
            <div>
                <div class="container">
                    <h3>Claims and return:</h3>
                    <p>The claims must be notified within a period of 14 days as from the date of invoicing, otherwise the delivery is seen as accepted. The articles currently being reproduced on the website can be returned over within a period of 14 days as from the date of invoicing.</p>
                </div>
            </div>
            <div class="gray-bg">
                <div class="container">
                    <h3>The following conditions are applicable:</h3>
                    <p>All the returned material must be in a mint condition and in the original package. <br>
                    All the articles must be complete. <br>
                    In the event of non-observance of these conditions, a corresponding deduction will be applied.</p>
                </div>
            </div> 
            <div>
                <div class="container">
                    <h3>Various:</h3>
                    <p>The customer will be able to find all the policies of EGRAPHIC DMCC in connection with XXSIM, the details and information on the product on the <a href="https://xxsim.com/">www.xxsim.com</a> site.</p>
                </div>
            </div>
            <div class="gray-bg">
                <div class="container">
                    <h3>Legal:</h3>
                    <p>The present convention is governed by the Swiss laws. The parties acknowledge the exclusive competence of the canton of Berne. The Convention of Vienna on the international sale contracts of goods is not applicable. If part of the conditions is declared worthless by a court, the validity of the remaining provisions of the conditions will not be affected. All the communications must be made in writing and sent to the legal person in charge of each party, to the address appearing in the invoice.</p>
                </div>
            </div> 
        </section>
    </main>
    @endsection
@endif