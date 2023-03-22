

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title> تسجيل حساب</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="{{asset('web/asset/bootstrap.css')}}"  crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{asset('web/asset/auth.css')}}">
	<link rel="stylesheet" href="{{asset('web/asset/all.css')}}">
    <link rel="stylesheet" href="{{asset('web/asset/bootstrap.css')}}">
    <link rel="Stylesheet" type="text/css" href="{{asset('web/asset/styles.css')}}">

	<style>
		.custom-file-label::after {
		   left: 0;
		   right: auto;
		   border-left-width: 0;
		   border-right: inherit;
	   }
	</style>
</head>

<body class="my-login-page" style="background-image: url(../../images/background.svg); background-size: cover; background-repeat: no-repeat;">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<h1 style="text-align: center; margin-top: 40px;">كوتبانه</h1>
					<hr>
					<div class="card fat">
						<div class="card-body">
							<h6 style="text-align: center; color: red;">انشر كتابك الرقمي بنفسك بخمسة دقائق كاتفاقية غير حصرية واحصل على 60% من المبيعات</h6>
							<h4 class="card-title text-center">  تسجيل حساب </h4>
							<form method="POST" class="my-login-validation text-right" novalidate="" action="register.php" enctype="multipart/form-data">
								<div class="form-group">
									<label for="name">الاسم</label>
									<input id="name" type="text" class="form-control" name="name" required="" autofocus="">
									<div class="invalid-feedback">
										الرجاء ادخال الاسم
									</div>
								</div>

								<div class="form-group">
									<label for="email">الايميل</label>
									<input id="email" type="email" class="form-control" name="email" required="">
									<div class="invalid-feedback">
										صيغة الايميل غير صحيحة
									</div>
								</div>

								<div class="form-group">
									<label for="country"> الدولة </label>
									<select name="country" id="country" class="form-control" required=""><option value="" disabled="disabled" selected="selected">  اختيار الدولة </option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Brazil">Brazil</option><option value="Brunei">Brunei</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burma">Burma</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo, Democratic Republic">Congo, Democratic Republic</option><option value="Congo, Republic of the">Congo, Republic of the</option><option value="Costa Rica">Costa Rica</option><option value="Cote d" ivoire'="">Cote d'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea North">Korea North</option><option value="Korea South">Korea South</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Mongolia">Mongolia</option><option value="Morocco">Morocco</option><option value="Monaco">Monaco</option><option value="Mozambique">Mozambique</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palestine">Palestine</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Qatar">Qatar</option><option value="Romania">Romania</option><option value="Russia">Russia</option><option value="Rwanda">Rwanda</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome">Sao Tome</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia and Montenegro">Serbia and Montenegro</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>
									<div class="invalid-feedback">
										الرجاء اختيار الدولة 
									</div>
								</div>

								<div class="form-group">
									<label for="state"> المدينة </label>
									<select name="state" id="state" class="form-control" required="">
									  </select>
									<div class="invalid-feedback">
										الرجاء اختيار المدينة 
									</div>
								</div>
								<div class="form-group">
									<label for="view"> نبذه عن الكاتب </label>
									<textarea id="view" type="text" class="form-control" name="view" required=""></textarea>
									<div class="invalid-feedback">
										الرجاء ادخال نبذه عنك
									</div>
								</div>

								<div class="form-group">
									<label for="phone"> الهاتف</label>
									<select id="phonecode" type="text" class="form-control" name="phonecode" required=""><option value="" disabled="disabled" selected="selected"> إختر الدولة  </option><option value="+376">أندورا +376</option><option value="+971">الامارات العربية المتحدة +971</option><option value="+93">أفغانستان +93</option><option value="+1">أنتيجوا وبربودا +1</option><option value="+1">أنجويلا +1</option><option value="+355">ألبانيا +355</option><option value="+374">أرمينيا +374</option><option value="+244">أنجولا +244</option><option value="+672">القطب الجنوبي +672</option><option value="+54">الأرجنتين +54</option><option value="+1">ساموا الأمريكية +1</option><option value="+43">النمسا +43</option><option value="+61">أستراليا +61</option><option value="+297">آروبا +297</option><option value="+358">جزر أولان +358</option><option value="+994">أذربيجان +994</option><option value="+387">البوسنة والهرسك +387</option><option value="+1">بربادوس +1</option><option value="+880">بنجلاديش +880</option><option value="+32">بلجيكا +32</option><option value="+226">بوركينا فاسو +226</option><option value="+359">بلغاريا +359</option><option value="+973">البحرين +973</option><option value="+257">بوروندي +257</option><option value="+229">بنين +229</option><option value="+590">سان بارتيلمي +590</option><option value="+1">برمودا +1</option><option value="+673">بروناي +673</option><option value="+591">بوليفيا +591</option><option value="+599">بونير +599</option><option value="+55">البرازيل +55</option><option value="+1">الباهاما +1</option><option value="+975">بوتان +975</option><option value="+47">جزيرة بوفيه +47</option><option value="+267">بتسوانا +267</option><option value="+375">روسيا البيضاء +375</option><option value="+501">بليز +501</option><option value="+1">كندا +1</option><option value="+61">جزر كوكوس +61</option><option value="+243">جمهورية الكونغو الديمقراطية +243</option><option value="+236">جمهورية افريقيا الوسطى +236</option><option value="+242">الكونغو - برازافيل +242</option><option value="+41">سويسرا +41</option><option value="+225">ساحل العاج +225</option><option value="+682">جزر كوك +682</option><option value="+56">شيلي +56</option><option value="+237">الكاميرون +237</option><option value="+86">الصين +86</option><option value="+57">كولومبيا +57</option><option value="+506">كوستاريكا +506</option><option value="+53">كوبا +53</option><option value="+238">الرأس الأخضر +238</option><option value="+599">كوراساو +599</option><option value="+61">جزيرة الكريسماس +61</option><option value="+357">قبرص +357</option><option value="+420">جمهورية التشيك +420</option><option value="+49">ألمانيا +49</option><option value="+253">جيبوتي +253</option><option value="+45">الدانمرك +45</option><option value="+1">دومينيكا +1</option><option value="+1">جمهورية الدومينيك +1</option><option value="+213">الجزائر +213</option><option value="+593">الاكوادور +593</option><option value="+372">استونيا +372</option><option value="+20">مصر +20</option><option value="+212">الصحراء الغربية +212</option><option value="+291">اريتريا +291</option><option value="+34">أسبانيا +34</option><option value="+251">اثيوبيا +251</option><option value="+358">فنلندا +358</option><option value="+679">فيجي +679</option><option value="+500">جزر فوكلاند +500</option><option value="+691">ميكرونيزيا +691</option><option value="+298">جزر فارو +298</option><option value="+33">فرنسا +33</option><option value="+241">الجابون +241</option><option value="+44">المملكة المتحدة +44</option><option value="+1">جرينادا +1</option><option value="+995">جورجيا +995</option><option value="+594">غويانا +594</option><option value="+44">غيرنزي +44</option><option value="+233">غانا +233</option><option value="+350">جبل طارق +350</option><option value="+299">جرينلاند +299</option><option value="+220">غامبيا +220</option><option value="+224">غينيا +224</option><option value="+590">جوادلوب +590</option><option value="+240">غينيا الاستوائية +240</option><option value="+30">اليونان +30</option><option value="+500">جورجيا الجنوبية وجزر ساندويتش الجنوبية +500</option><option value="+502">جواتيمالا +502</option><option value="+1">جوام +1</option><option value="+245">غينيا بيساو +245</option><option value="+595">غيانا +595</option><option value="+852">هونج كونج الصينية +852</option><option value="">جزيرة هيرد وماكدونالد </option><option value="+504">هندوراس +504</option><option value="+385">كرواتيا +385</option><option value="+509">هايتي +509</option><option value="+36">المجر +36</option><option value="+62">اندونيسيا +62</option><option value="+353">أيرلندا +353</option><option value="+972">اسرائيل +972</option><option value="+44">جزيرة مان +44</option><option value="+91">الهند +91</option><option value="+246">المحيط الهندي البريطاني +246</option><option value="+964">العراق +964</option><option value="+98">ايران +98</option><option value="+354">أيسلندا +354</option><option value="+39">ايطاليا +39</option><option value="+44">جيرسي +44</option><option value="+1">جامايكا +1</option><option value="+962">الأردن +962</option><option value="+81">اليابان +81</option><option value="+254">كينيا +254</option><option value="+996">قرغيزستان +996</option><option value="+855">كمبوديا +855</option><option value="+686">كيريباتي +686</option><option value="+269">جزر القمر +269</option><option value="+1">سانت كيتس ونيفيس +1</option><option value="+850">كوريا الشمالية +850</option><option value="+82">كوريا الجنوبية +82</option><option value="+965">الكويت +965</option><option value="+345">جزر الكايمن +345</option><option value="+7">كازاخستان +7</option><option value="+856">لاوس +856</option><option value="+961">لبنان +961</option><option value="+1">سانت لوسيا +1</option><option value="+423">ليختنشتاين +423</option><option value="+94">سريلانكا +94</option><option value="+231">ليبيريا +231</option><option value="+266">ليسوتو +266</option><option value="+370">ليتوانيا +370</option><option value="+352">لوكسمبورج +352</option><option value="+371">لاتفيا +371</option><option value="+218">ليبيا +218</option><option value="+212">المغرب +212</option><option value="+377">موناكو +377</option><option value="+373">مولدافيا +373</option><option value="+382">الجبل الأسود +382</option><option value="+590">سانت مارتين +590</option><option value="+261">مدغشقر +261</option><option value="+692">جزر المارشال +692</option><option value="+389">مقدونيا +389</option><option value="+223">مالي +223</option><option value="+95">ميانمار +95</option><option value="+976">منغوليا +976</option><option value="+853">ماكاو الصينية +853</option><option value="+1">جزر ماريانا الشمالية +1</option><option value="+596">مارتينيك +596</option><option value="+222">موريتانيا +222</option><option value="+1">مونتسرات +1</option><option value="+356">مالطا +356</option><option value="+230">موريشيوس +230</option><option value="+960">جزر الملديف +960</option><option value="+265">ملاوي +265</option><option value="+52">المكسيك +52</option><option value="+60">ماليزيا +60</option><option value="+258">موزمبيق +258</option><option value="+264">ناميبيا +264</option><option value="+687">كاليدونيا الجديدة +687</option><option value="+227">النيجر +227</option><option value="+672">جزيرة نورفوك +672</option><option value="+234">نيجيريا +234</option><option value="+505">نيكاراجوا +505</option><option value="+31">هولندا +31</option><option value="+47">النرويج +47</option><option value="+977">نيبال +977</option><option value="+674">نورو +674</option><option value="+683">نيوي +683</option><option value="+64">نيوزيلاندا +64</option><option value="+968">عمان +968</option><option value="+507">بنما +507</option><option value="+51">بيرو +51</option><option value="+689">بولينيزيا الفرنسية +689</option><option value="+675">بابوا غينيا الجديدة +675</option><option value="+63">الفيلبين +63</option><option value="+92">باكستان +92</option><option value="+48">بولندا +48</option><option value="+508">سانت بيير وميكولون +508</option><option value="+872">بتكايرن +872</option><option value="+1">بورتوريكو +1</option><option value="+970">فلسطين +970</option><option value="+351">البرتغال +351</option><option value="+680">بالاو +680</option><option value="+595">باراجواي +595</option><option value="+974">قطر +974</option><option value="+262">روينيون +262</option><option value="+40">رومانيا +40</option><option value="+381">صربيا +381</option><option value="+7">روسيا +7</option><option value="+250">رواندا +250</option><option value="+966">المملكة العربية السعودية +966</option><option value="+677">جزر سليمان +677</option><option value="+248">سيشل +248</option><option value="+249">السودان +249</option><option value="+46">السويد +46</option><option value="+65">سنغافورة +65</option><option value="+290">سانت هيلنا +290</option><option value="+386">سلوفينيا +386</option><option value="+47">سفالبارد وجان مايان +47</option><option value="+421">سلوفاكيا +421</option><option value="+232">سيراليون +232</option><option value="+378">سان مارينو +378</option><option value="+221">السنغال +221</option><option value="+252">الصومال +252</option><option value="+597">سورينام +597</option><option value="+211">جنوب السودان +211</option><option value="+239">ساو تومي وبرينسيبي +239</option><option value="+503">السلفادور +503</option><option value="+1">سينت مارتن +1</option><option value="+963">سوريا +963</option><option value="+268">سوازيلاند +268</option><option value="+1">جزر الترك وجايكوس +1</option><option value="+235">تشاد +235</option><option value="+262">المقاطعات الجنوبية الفرنسية +262</option><option value="+228">توجو +228</option><option value="+66">تايلند +66</option><option value="+992">طاجكستان +992</option><option value="+690">توكيلو +690</option><option value="+670">تيمور الشرقية +670</option><option value="+993">تركمانستان +993</option><option value="+216">تونس +216</option><option value="+676">تونجا +676</option><option value="+90">تركيا +90</option><option value="+1">ترينيداد وتوباغو +1</option><option value="+688">توفالو +688</option><option value="+886">تايوان +886</option><option value="+255">تانزانيا +255</option><option value="+380">أوكرانيا +380</option><option value="+256">أوغندا +256</option><option value="">جزر الولايات المتحدة البعيدة الصغيرة </option><option value="+1">الولايات المتحدة الأمريكية +1</option><option value="+598">أورجواي +598</option><option value="+998">أوزبكستان +998</option><option value="+379">الفاتيكان +379</option><option value="+1">سانت فنسنت وغرنادين +1</option><option value="+58">فنزويلا +58</option><option value="+1">جزر فرجين البريطانية +1</option><option value="+1">جزر فرجين الأمريكية +1</option><option value="+84">فيتنام +84</option><option value="+678">فانواتو +678</option><option value="+681">جزر والس وفوتونا +681</option><option value="+685">ساموا +685</option><option value="+383">كوسوفو +383</option><option value="+967">اليمن +967</option><option value="+262">مايوت +262</option><option value="+27">جمهورية جنوب افريقيا +27</option><option value="+260">زامبيا +260</option><option value="+263">زيمبابوي +263</option></select>
									<input id="phone" type="number" class="form-control" name="phone" placeholder="رقم الجوال" required="">
									<div class="error"></div>
									<div class="invalid-feedback">
										الرجاء ادخال الهاتف
									</div>
								</div>

							    <div class="form-group">
									<label for="password">كلمة السر</label>
									<div style="position:relative" id="eye-password-0"><input id="password" type="password" class="form-control" name="password" required="" data-eye="" style="padding-right: 60px;"><div class="invalid-feedback">
										الرجاء ادخال كلمة السر
									</div><input type="hidden" id="passeye-0"><div class="btn btn-primary btn-sm" id="passeye-toggle-0" style="position: absolute; right: 10px; top: 7px; padding: 2px 7px; font-size: 12px; cursor: pointer;">Show</div></div>
									<div class="error"></div>
									<div class="invalid-feedback">
										الرجاء ادخال كلمة السر
									</div>
								</div>
								<div class="form-group">
									<label for="re-password">تأكيد ادخال كلمة السر </label>
									<div style="position:relative" id="eye-password-1"><input id="re-password" type="password" class="form-control" name="re-password" required="" data-eye="" style="padding-right: 60px;"><div class="invalid-feedback">
										الرجاء اعاده ادخال كلمة السر
									</div><input type="hidden" id="passeye-1"><div class="btn btn-primary btn-sm" id="passeye-toggle-1" style="position: absolute; right: 10px; top: 7px; padding: 2px 7px; font-size: 12px; cursor: pointer;">Show</div></div>
									<div class="error"></div>
									<div class="invalid-feedback">
										الرجاء اعاده ادخال كلمة السر
									</div>
								</div>							
								<div class="form-group">
									<label for="passport"> صورة الجواز </label>
									<div class="custom-file">
                                   		<input type="file" name="passport" class="form-control custom-file-input" id="passport" onchange="$(this).next().after().text($(this).val().split('\\').slice(-1)[0])" required="">
										<label class="custom-file-label" data-browse="رفع الملف من جهازك" for="passport">  </label>
								    </div>
									<div class="invalid-feedback">
									  يجب رفع صورة الجواز 
									</div>
                                </div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
										<label for="agree" class="custom-control-label">
											<button type="button" class="btn btn-success openBtn"> الشروط والأحكام</button>
											<!-- <a href="terms_and_conditions.php">الشروط والاحكام</a> -->
											اوافق على </label>
										<div class="invalid-feedback">
											يجب الموافقة على الشروط والأحكام
										</div>
										<!-- Popup of terms and condition -->
										<!-- Modal -->
										<div class="modal fade" id="myModal" role="dialog">
    										<div class="modal-dialog">
      										    <!-- Modal content-->
       											<div class="modal-content">
            										<div class="modal-header">
               											<button type="button" class="close" data-dismiss="modal">×</button>
               											<h4 class="modal-title"> الشروط والأحكام</h4>
            										</div>
            									    <div class="modal-body">

           										    </div>
            									    <div class="modal-footer">
                								   		<button type="button" class="btn btn-success" data-dismiss="modal"> قرأت الشروط والأحكام</button>
            								    	</div>
        									    </div>
    									    </div>
										</div>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block" id="savebtn" onclick="return checkRegisterForm()">
										تسجيل حساب
									</button>
								</div>
								<div class="mt-4 text-center">
									لديك حساب مسبقا؟ <a href="https://kutuphanah.com/pages/auth/login.html">تسجيل الدخول</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright © 2020 — كوتبانه
					</div>
				</div>
			</div>
		</div>
	</section>

	
	<script src="{{asset('web/asset/bootstrap_002.js')}}"  crossorigin="anonymous"></script>
		
		
	<script src="{{asset('web/asset/jquery.js')}}"></script>

	
	<script src="{{asset('web/asset/jquery-3.js')}}"  crossorigin="anonymous"></script>
	<script src="{{asset('web/asset/popper.js')}}" crossorigin="anonymous"></script>
	<script src="{{asset('web/asset/bootstrap.js')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('web/asset/author.js')}}"></script>



</body></html>