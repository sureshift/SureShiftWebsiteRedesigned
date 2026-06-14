/* SureShift app.js v5.0 — PHP 7.4 compatible build */
(function () {
  'use strict';

  var AJAX  = (typeof SS !== 'undefined') ? SS.ajax  : '/wp-admin/admin-ajax.php';
  var NONCE = (typeof SS !== 'undefined') ? SS.nonce : '';

  /* ══════════════════════════════════════════════
     SERVICE DATA — 12 services, unique fields
  ══════════════════════════════════════════════ */
  var SVC_ICONS = {
    user:  'M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2 M12 11a4 4 0 100-8 4 4 0 000 8z',
    phone: 'M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.1 2.14 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z',
    mail:  'M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z M22 6l-10 7L2 6',
    pin:   'M12 2a8 8 0 00-8 8c0 5.25 7.05 11.5 7.35 11.76a1 1 0 001.3 0C13 21.5 20 15.25 20 10a8 8 0 00-8-8z M12 13a3 3 0 100-6 3 3 0 000 6z',
    globe: 'M12 2a10 10 0 100 20A10 10 0 0012 2z M2 12h20',
    home:  'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z M9 22V12h6v10',
    bld:   'M2 20h20M6 20V4h12v16M10 9h4M10 13h4',
    car:   'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z',
    bike:  'M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11 M12 17h9',
    box:   'M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z',
    chk:   'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
    cal:   'M8 2v4 M16 2v4 M3 10h18 M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z',
    ppl:   'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2 M23 21v-2a4 4 0 00-3-3.87 M16 3.13a4 4 0 010 7.75',
    shld:  'M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 01-.68 0C7.5 20.5 4 18 4 13V6l8-3 8 3v7z',
    truck: 'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 M18.5 21a2.5 2.5 0 100-5'
  };

  var SERVICES = [
    {
      id: 'household', label: 'Household', hint: 'Residential relocation anywhere in India',
      ico: 'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z M9 22V12h6v10',
      fields: [
        { id:'name',     label:'Full Name',        type:'text',   ph:'Rajesh Kumar',   req:true,  ico:'user' },
        { id:'phone',    label:'Mobile Number',    type:'tel',    ph:'98765 43210',    req:true,  ico:'phone' },
        { id:'email',    label:'Email Address',    type:'email',  ph:'you@email.com',  req:false, ico:'mail' },
        { id:'apt_size', label:'Property Size',    type:'select', req:false, ico:'home',
          opts:['Studio','1 BHK','2 BHK','3 BHK','4 BHK','4+ BHK','Villa / Bungalow'] },
        { id:'from',     label:'Pickup City',      type:'text',   ph:'Delhi',          req:true,  ico:'pin' },
        { id:'to',       label:'Destination City', type:'text',   ph:'Mumbai',         req:true,  ico:'pin' },
        { id:'move_date',label:'Preferred Date',   type:'date',   req:false, ico:'cal' },
        { id:'packing',  label:'Packing Service',  type:'select', req:false, ico:'box',
          opts:['Full Packing & Unpacking','Partial Packing','No Packing Needed'] }
      ]
    },
    {
      id: 'office', label: 'Office', hint: 'Corporate & commercial office relocation',
      ico: 'M2 20h20M6 20V4h12v16M10 9h4M10 13h4',
      fields: [
        { id:'name',        label:'Contact Person',    type:'text',   ph:'Amit Sharma',           req:true,  ico:'user' },
        { id:'company',     label:'Company Name',      type:'text',   ph:'Acme Pvt Ltd',          req:true,  ico:'bld' },
        { id:'phone',       label:'Mobile Number',     type:'tel',    ph:'98765 43210',            req:true,  ico:'phone' },
        { id:'email',       label:'Business Email',    type:'email',  ph:'office@company.com',    req:true,  ico:'mail' },
        { id:'employees',   label:'No. of Employees',  type:'select', req:false, ico:'ppl',
          opts:['1-10','11-50','51-100','101-250','250+'] },
        { id:'office_size', label:'Office Size',       type:'select', req:false, ico:'home',
          opts:['Under 500 sq.ft','500-1000 sq.ft','1000-2500 sq.ft','2500-5000 sq.ft','5000+ sq.ft'] },
        { id:'from',        label:'Current Location',  type:'text',   ph:'Connaught Place, Delhi', req:true,  ico:'pin' },
        { id:'to',          label:'New Location',      type:'text',   ph:'BKC, Mumbai',            req:true,  ico:'pin' },
        { id:'move_date',   label:'Target Move Date',  type:'date',   req:false, ico:'cal' },
        { id:'it_assets',   label:'IT / Server Assets',type:'select', req:false, ico:'box',
          opts:['Yes - needs special handling','No - standard furniture only'] }
      ]
    },
    {
      id: 'international', label: 'International', hint: 'Global relocation to 88+ countries',
      ico: 'M12 2a10 10 0 100 20A10 10 0 0012 2z M2 12h20 M12 2a15.3 15.3 0 000 20',
      fields: [
        { id:'name',          label:'Full Name',             type:'text',  ph:'Priya Mehta',       req:true,  ico:'user' },
        { id:'phone',         label:'Mobile Number',         type:'tel',   ph:'98765 43210',        req:true,  ico:'phone' },
        { id:'email',         label:'Email Address',         type:'email', ph:'you@email.com',     req:true,  ico:'mail' },
        { id:'from',          label:'Origin City, Country',  type:'text',  ph:'New Delhi, India',  req:true,  ico:'pin' },
        { id:'to',            label:'Destination Country',   type:'text',  ph:'Dubai, UAE',        req:true,  ico:'globe' },
        { id:'shipment_type', label:'Shipment Mode',         type:'select',req:false, ico:'box',
          opts:['Sea Freight FCL (Full Container)','Sea Freight LCL (Shared)','Air Freight','Road Transport'] },
        { id:'apt_size',      label:'Property Size',         type:'select',req:false, ico:'home',
          opts:['Studio','1 BHK','2 BHK','3 BHK','4 BHK','4+ BHK','Office / Commercial'] },
        { id:'move_date',     label:'Expected Move Month',   type:'date',  req:false, ico:'cal' },
        { id:'visa_status',   label:'Visa / Immigration',    type:'select',req:false, ico:'chk',
          opts:['Visa Approved','Visa in Process','Work Permit','Student Visa','PR / Citizenship'] }
      ]
    },
    {
      id: 'car', label: 'Car Transport', hint: 'Safe & insured car transport across India',
      ico: 'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z',
      fields: [
        { id:'name',           label:'Full Name',           type:'text',   ph:'Arjun Singh',         req:true,  ico:'user' },
        { id:'phone',          label:'Mobile Number',       type:'tel',    ph:'98765 43210',          req:true,  ico:'phone' },
        { id:'email',          label:'Email Address',       type:'email',  ph:'you@email.com',       req:false, ico:'mail' },
        { id:'car_make',       label:'Car Make & Model',    type:'text',   ph:'Honda City / Swift',  req:true,  ico:'car' },
        { id:'car_year',       label:'Year of Manufacture', type:'select', req:false, ico:'cal',
          opts:['2020-2025','2015-2019','2010-2014','2005-2009','Before 2005'] },
        { id:'car_condition',  label:'Car Condition',       type:'select', req:false, ico:'chk',
          opts:['Running / Drivable','Non-Running - Needs Towing'] },
        { id:'transport_type', label:'Transport Mode',      type:'select', req:false, ico:'box',
          opts:['Enclosed Carrier (Recommended)','Open Carrier','Door-to-Door','Terminal-to-Terminal'] },
        { id:'from',           label:'Pickup City',         type:'text',   ph:'Delhi',               req:true,  ico:'pin' },
        { id:'to',             label:'Drop City',           type:'text',   ph:'Bengaluru',           req:true,  ico:'pin' },
        { id:'move_date',      label:'Pickup Date',         type:'date',   req:false, ico:'cal' }
      ]
    },
    {
      id: 'bike', label: 'Bike Transport', hint: 'Two-wheeler transport with full safety packaging',
      ico: 'M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11 M12 17h9',
      fields: [
        { id:'name',      label:'Full Name',         type:'text',   ph:'Rohit Verma',               req:true,  ico:'user' },
        { id:'phone',     label:'Mobile Number',     type:'tel',    ph:'98765 43210',                req:true,  ico:'phone' },
        { id:'email',     label:'Email Address',     type:'email',  ph:'you@email.com',             req:false, ico:'mail' },
        { id:'bike_make', label:'Bike Make & Model', type:'text',   ph:'Royal Enfield Bullet 350',  req:true,  ico:'bike' },
        { id:'bike_type', label:'Bike Type',         type:'select', req:false, ico:'chk',
          opts:['Standard / Commuter','Sports / Superbike','Cruiser','Scooter / Moped','Electric Bike'] },
        { id:'from',      label:'Pickup City',       type:'text',   ph:'Pune',                      req:true,  ico:'pin' },
        { id:'to',        label:'Drop City',         type:'text',   ph:'Hyderabad',                 req:true,  ico:'pin' },
        { id:'move_date', label:'Pickup Date',       type:'date',   req:false, ico:'cal' },
        { id:'packaging', label:'Packaging Needed',  type:'select', req:false, ico:'box',
          opts:['Yes - full bubble wrap & crating','No - standard transport'] }
      ]
    },
    {
      id: 'storage', label: 'Storage', hint: 'Climate-controlled secure storage facilities',
      ico: 'M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 01-.68 0C7.5 20.5 4 18 4 13V6l8-3 8 3v7z',
      fields: [
        { id:'name',         label:'Full Name',        type:'text',   ph:'Sunita Kapoor',  req:true,  ico:'user' },
        { id:'phone',        label:'Mobile Number',    type:'tel',    ph:'98765 43210',     req:true,  ico:'phone' },
        { id:'email',        label:'Email Address',    type:'email',  ph:'you@email.com',  req:false, ico:'mail' },
        { id:'from',         label:'Your City',        type:'text',   ph:'Chennai',        req:true,  ico:'pin' },
        { id:'storage_size', label:'Volume Estimate',  type:'select', req:false, ico:'box',
          opts:['Small - up to 50 cu.ft','Medium - 50-150 cu.ft','Large - 150-300 cu.ft','Extra Large - 300+ cu.ft'] },
        { id:'storage_type', label:'Storage Type',     type:'select', req:false, ico:'shld',
          opts:['Self-Storage Unit','Managed Storage (we handle)','Climate-Controlled','24/7 Access Required'] },
        { id:'duration',     label:'Duration Needed',  type:'select', req:false, ico:'cal',
          opts:['Less than 1 month','1-3 months','3-6 months','6-12 months','More than 1 year'] },
        { id:'items',        label:'Items Category',   type:'select', req:false, ico:'home',
          opts:['Household Goods','Office Equipment','Vehicles','Documents / Records','Fine Arts / Antiques'] },
        { id:'move_date',    label:'Start Date',       type:'date',   req:false, ico:'cal' }
      ]
    },
    {
      id: 'fine-arts', label: 'Fine Arts', hint: 'White-glove handling for art, antiques & valuables',
      ico: 'M2 20h20M4 20V8l8-6 8 6v12',
      fields: [
        { id:'name',       label:'Full Name',         type:'text',   ph:'Dr. Vikram Rao',  req:true,  ico:'user' },
        { id:'phone',      label:'Mobile Number',     type:'tel',    ph:'98765 43210',      req:true,  ico:'phone' },
        { id:'email',      label:'Email Address',     type:'email',  ph:'you@email.com',   req:true,  ico:'mail' },
        { id:'from',       label:'Collection City',   type:'text',   ph:'Mumbai',          req:true,  ico:'pin' },
        { id:'to',         label:'Delivery City',     type:'text',   ph:'New Delhi',       req:true,  ico:'pin' },
        { id:'item_type',  label:'Type of Artwork',   type:'select', req:false, ico:'chk',
          opts:['Paintings / Canvas','Sculptures','Antique Furniture','Rare Books / Manuscripts','Musical Instruments','Jewellery / Valuables','Mixed Collection'] },
        { id:'quantity',   label:'Number of Items',   type:'select', req:false, ico:'box',
          opts:['1-5 items','6-15 items','16-30 items','30+ items'] },
        { id:'value_range',label:'Approximate Value', type:'select', req:false, ico:'chk',
          opts:['Under 5 Lakhs','5-25 Lakhs','25-100 Lakhs','1 Crore+'] },
        { id:'move_date',  label:'Preferred Date',    type:'date',   req:false, ico:'cal' }
      ]
    },
    {
      id: 'commercial', label: 'Commercial', hint: 'Factory, warehouse & industrial relocation',
      ico: 'M3 9l9-7 9 7v11H3V9z',
      fields: [
        { id:'name',      label:'Contact Person',    type:'text',   ph:'Rajesh Kumar',        req:true,  ico:'user' },
        { id:'company',   label:'Company / Factory', type:'text',   ph:'Steel Corp Pvt Ltd',  req:true,  ico:'bld' },
        { id:'phone',     label:'Mobile Number',     type:'tel',    ph:'98765 43210',          req:true,  ico:'phone' },
        { id:'email',     label:'Business Email',    type:'email',  ph:'ops@company.com',     req:true,  ico:'mail' },
        { id:'industry',  label:'Industry Type',     type:'select', req:false, ico:'chk',
          opts:['Manufacturing','Warehousing / Logistics','Retail / Showroom','Healthcare / Pharma','IT / Data Centre','FMCG / F&B'] },
        { id:'from',      label:'Current Location',  type:'text',   ph:'Gurgaon, Haryana',    req:true,  ico:'pin' },
        { id:'to',        label:'New Location',      type:'text',   ph:'Noida, UP',           req:true,  ico:'pin' },
        { id:'machinery', label:'Heavy Machinery',   type:'select', req:false, ico:'box',
          opts:['Yes - crane / rigging required','No - standard equipment only'] },
        { id:'move_date', label:'Target Move Date',  type:'date',   req:false, ico:'cal' }
      ]
    },
    {
      id: 'courier', label: 'Courier', hint: 'Express parcel & document delivery services',
      ico: 'M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z',
      fields: [
        { id:'name',         label:'Sender Name',      type:'text',   ph:'Kavita Sharma',  req:true,  ico:'user' },
        { id:'phone',        label:'Mobile Number',    type:'tel',    ph:'98765 43210',     req:true,  ico:'phone' },
        { id:'email',        label:'Email Address',    type:'email',  ph:'you@email.com',  req:false, ico:'mail' },
        { id:'from',         label:'Pickup Pincode',   type:'text',   ph:'110001',         req:true,  ico:'pin' },
        { id:'to',           label:'Delivery Pincode', type:'text',   ph:'400001',         req:true,  ico:'pin' },
        { id:'parcel_type',  label:'Parcel Type',      type:'select', req:false, ico:'box',
          opts:['Document','Small Parcel under 5 kg','Medium 5-25 kg','Heavy Cargo 25 kg+','Fragile Items'] },
        { id:'weight',       label:'Approx Weight',    type:'select', req:false, ico:'chk',
          opts:['Under 1 kg','1-5 kg','5-10 kg','10-25 kg','25 kg+'] },
        { id:'service_type', label:'Delivery Speed',   type:'select', req:false, ico:'cal',
          opts:['Same Day','Next Day Express','Standard 2-3 Days','Economy 5-7 Days'] },
        { id:'move_date',    label:'Pickup Date',      type:'date',   req:false, ico:'cal' }
      ]
    },
    {
      id: 'truck', label: 'Truck Rental', hint: 'Hire trucks on-demand for any type of load',
      ico: 'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 M18.5 21a2.5 2.5 0 100-5',
      fields: [
        { id:'name',       label:'Full Name',           type:'text',   ph:'Manoj Tiwari',          req:true,  ico:'user' },
        { id:'phone',      label:'Mobile Number',       type:'tel',    ph:'98765 43210',             req:true,  ico:'phone' },
        { id:'email',      label:'Email Address',       type:'email',  ph:'you@email.com',          req:false, ico:'mail' },
        { id:'from',       label:'Pickup Location',     type:'text',   ph:'Sector 18, Noida',       req:true,  ico:'pin' },
        { id:'to',         label:'Drop Location',       type:'text',   ph:'Agra',                   req:true,  ico:'pin' },
        { id:'truck_type', label:'Truck Size',          type:'select', req:false, ico:'truck',
          opts:['Mini Truck up to 750 kg','Small up to 3 Ton','Medium 3-7 Ton','Large 7-15 Ton','Trailer 15 Ton+'] },
        { id:'load_type',  label:'Type of Load',        type:'select', req:false, ico:'box',
          opts:['Household Goods','Construction Material','Industrial Equipment','Agricultural Produce','E-commerce'] },
        { id:'move_date',  label:'Required From Date',  type:'date',   req:false, ico:'cal' },
        { id:'duration',   label:'Rental Duration',     type:'select', req:false, ico:'cal',
          opts:['Single Trip','Per Day 1-3 days','Weekly','Monthly Contract'] }
      ]
    },
    {
      id: 'last-mile', label: 'Last Mile', hint: 'Fast local delivery within the city',
      ico: 'M5 12h14M12 5l7 7-7 7',
      fields: [
        { id:'name',         label:'Business / Name',    type:'text',   ph:'QuickMart Store',         req:true,  ico:'user' },
        { id:'phone',        label:'Mobile Number',      type:'tel',    ph:'98765 43210',              req:true,  ico:'phone' },
        { id:'email',        label:'Email Address',      type:'email',  ph:'you@email.com',           req:false, ico:'mail' },
        { id:'from',         label:'Warehouse / Origin', type:'text',   ph:'Okhla Industrial, Delhi', req:true,  ico:'pin' },
        { id:'to',           label:'Delivery Area',      type:'text',   ph:'South Delhi',             req:true,  ico:'pin' },
        { id:'volume',       label:'Daily Order Volume', type:'select', req:false, ico:'box',
          opts:['Under 50/day','50-200/day','200-500/day','500-1000/day','1000+/day'] },
        { id:'vehicle_type', label:'Vehicle Preference', type:'select', req:false, ico:'car',
          opts:['Two-Wheeler (bike)','Three-Wheeler (e-rickshaw)','Mini Van','Any Available'] },
        { id:'contract',     label:'Contract Type',      type:'select', req:false, ico:'chk',
          opts:['One-Time','Daily Recurring','Weekly','Monthly Partnership'] },
        { id:'move_date',    label:'Start Date',         type:'date',   req:false, ico:'cal' }
      ]
    },
    {
      id: 'odc', label: 'ODC', hint: 'Over-dimensional cargo & project logistics',
      ico: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
      fields: [
        { id:'name',       label:'Contact Person',     type:'text',   ph:'K. Subramaniam',        req:true,  ico:'user' },
        { id:'company',    label:'Company Name',       type:'text',   ph:'Heavy Industries Ltd',  req:true,  ico:'bld' },
        { id:'phone',      label:'Mobile Number',      type:'tel',    ph:'98765 43210',            req:true,  ico:'phone' },
        { id:'email',      label:'Business Email',     type:'email',  ph:'projects@company.com',  req:true,  ico:'mail' },
        { id:'from',       label:'Origin Location',    type:'text',   ph:'Vizag Port, AP',        req:true,  ico:'pin' },
        { id:'to',         label:'Destination',        type:'text',   ph:'JNPT Mumbai',           req:true,  ico:'pin' },
        { id:'cargo_type', label:'Cargo Type',         type:'select', req:false, ico:'box',
          opts:['Industrial Machinery','Transformers / Reactors','Structural Steel','Wind Turbine Parts','Defence Equipment','Modular Buildings'] },
        { id:'weight',     label:'Cargo Weight',       type:'select', req:false, ico:'chk',
          opts:['Up to 5 Tons','5-20 Tons','20-50 Tons','50-100 Tons','100 Tons+'] },
        { id:'dimensions', label:'Dimensions L x W x H',type:'text',  ph:'e.g. 12m x 3m x 4m',  req:false, ico:'chk' },
        { id:'move_date',  label:'Dispatch Date',      type:'date',   req:false, ico:'cal' }
      ]
    }
  ];

  /* ══════════════════════════════════════════════
     HELPERS
  ══════════════════════════════════════════════ */
  function mkSvg(path, size) {
    return '<svg width="' + (size||14) + '" height="' + (size||14) + '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="' + path + '"/></svg>';
  }
  function esc(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  /* ══════════════════════════════════════════════
     ENQUIRY FORM
  ══════════════════════════════════════════════ */
  document.addEventListener('DOMContentLoaded', function () {
    initForm();
    initNav();
    initTracking();
    initScrollTop();
    initReveal();
    initSticky();
  });

  function initForm() {
    var card = document.getElementById('quote');
    if (!card) return;

    var svcGrid  = card.querySelector('.eq-svcs');
    var fieldsEl = card.querySelector('.eq-fields');
    var msgEl    = card.querySelector('.eq-msg');
    var submitEl = card.querySelector('.eq-submit');
    var btnTxtEl = card.querySelector('.eq-btn-txt');
    var fillEl   = card.querySelector('.eq-fill');
    var stepEl   = card.querySelector('.eq-step-tag');

    var current = null;

    /* Build service grid */
    SERVICES.forEach(function (svc) {
      var btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'eq-svc';
      btn.setAttribute('data-id', svc.id);
      btn.setAttribute('role', 'tab');
      btn.setAttribute('aria-selected', 'false');
      btn.innerHTML =
        '<div class="eq-svc-ico">' + mkSvg(svc.ico, 16) + '</div>' +
        '<span>' + esc(svc.label) + '</span>';
      btn.addEventListener('click', function () { selectSvc(svc); });
      svcGrid.appendChild(btn);
    });

    /* Select a service */
    function selectSvc(svc) {
      current = svc;
      svcGrid.querySelectorAll('.eq-svc').forEach(function (b) {
        var on = b.getAttribute('data-id') === svc.id;
        b.classList.toggle('active', on);
        b.setAttribute('aria-selected', on ? 'true' : 'false');
      });
      buildFields(svc);
      if (submitEl) submitEl.disabled = false;
      if (btnTxtEl) btnTxtEl.textContent = 'Get Free Quote';
      clearMsg();
      updateBar();
    }

    /* Build fields */
    function buildFields(svc) {
      fieldsEl.innerHTML = '';

      var hint = document.createElement('p');
      hint.className = 'eq-service-hint';
      hint.textContent = svc.hint;
      fieldsEl.appendChild(hint);

      var grid = document.createElement('div');
      grid.className = 'eq-grid';

      svc.fields.forEach(function (f) {
        var wrap = document.createElement('div');
        wrap.className = 'eq-field';

        var lbl = document.createElement('label');
        lbl.setAttribute('for', 'eq-' + f.id);
        lbl.innerHTML = esc(f.label) + (f.req ? ' <span class="req" aria-hidden="true">*</span>' : '');
        wrap.appendChild(lbl);

        var iw = document.createElement('div');
        iw.className = 'eq-iw';
        iw.innerHTML = '<svg class="eq-ico" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="' + (SVC_ICONS[f.ico] || SVC_ICONS.chk) + '"/></svg>';

        var el;
        if (f.type === 'select') {
          el = document.createElement('select');
          var defOpt = document.createElement('option');
          defOpt.value = ''; defOpt.textContent = 'Select...';
          el.appendChild(defOpt);
          (f.opts || []).forEach(function (o) {
            var opt = document.createElement('option');
            opt.value = o; opt.textContent = o;
            el.appendChild(opt);
          });
        } else {
          el = document.createElement('input');
          el.type = f.type;
          el.placeholder = f.ph || '';
          if (f.type === 'date') {
            el.min = new Date().toISOString().split('T')[0];
          }
        }

        el.id   = 'eq-' + f.id;
        el.name = f.id;
        if (f.req) { el.required = true; el.setAttribute('aria-required', 'true'); }

        var acMap = { name: 'name', phone: 'tel', email: 'email' };
        if (acMap[f.id]) el.autocomplete = acMap[f.id];

        el.addEventListener('focus',  function () { iw.classList.add('focused'); updateBar(); });
        el.addEventListener('blur',   function () { iw.classList.remove('focused'); });
        el.addEventListener('input',  function () { el.classList.remove('err'); updateBar(); });
        el.addEventListener('change', function () { el.classList.remove('err'); updateBar(); });

        iw.appendChild(el);
        wrap.appendChild(iw);
        grid.appendChild(wrap);
      });

      fieldsEl.appendChild(grid);

      /* Hidden service field */
      var sh = document.createElement('input');
      sh.type = 'hidden'; sh.name = 'service'; sh.value = svc.label;
      fieldsEl.appendChild(sh);

      if (stepEl) stepEl.textContent = svc.fields.length + ' fields';
      updateBar();
    }

    /* Progress bar */
    function updateBar() {
      if (!fillEl || !current) return;
      var inputs = fieldsEl.querySelectorAll('input:not([type=hidden]),select');
      var filled = 0;
      inputs.forEach(function (el) { if (el.value && el.value.trim()) filled++; });
      var pct = inputs.length > 0 ? Math.round(filled / inputs.length * 100) : 0;
      fillEl.style.width = pct + '%';
    }

    /* Submit */
    if (submitEl) {
      submitEl.addEventListener('click', function () {
        if (!current) return;
        clearMsg();

        var firstErr = null;
        fieldsEl.querySelectorAll('input[required],select[required]').forEach(function (el) {
          el.classList.remove('err');
          if (!el.value.trim()) { el.classList.add('err'); if (!firstErr) firstErr = el; }
        });

        var phoneEl = fieldsEl.querySelector('input[name="phone"]');
        if (phoneEl && phoneEl.value) {
          var ph = phoneEl.value.replace(/\s+/g, '');
          if (!/^[6-9][0-9]{9}$/.test(ph)) {
            phoneEl.classList.add('err');
            if (!firstErr) firstErr = phoneEl;
            showMsg('Enter a valid 10-digit Indian mobile number.', 'er');
            phoneEl.focus();
            return;
          }
        }

        if (firstErr) { showMsg('Please fill all required fields.', 'er'); firstErr.focus(); return; }

        submitEl.disabled = true;
        if (btnTxtEl) btnTxtEl.textContent = 'Sending...';

        var fd = new FormData();
        fd.append('action',   'ss_quote');
        fd.append('nonce',    NONCE);
        fd.append('_wpnonce', NONCE);
        fieldsEl.querySelectorAll('input,select').forEach(function (el) {
          if (el.name) fd.append(el.name, el.value);
        });

        fetch(AJAX, { method: 'POST', body: fd, credentials: 'same-origin' })
          .then(function (r) { return r.json(); })
          .then(function (d) {
            if (d.success) {
              showMsg(d.data.msg || "Thank you! We'll call you within 30 minutes.", 'ok');
              fieldsEl.querySelectorAll('input:not([type=hidden]),select').forEach(function (el) { el.value = ''; });
              fillEl.style.width = '0%';
            } else {
              showMsg(d.data.msg || 'Something went wrong. Please call 90 732 91 732.', 'er');
            }
          })
          .catch(function () { showMsg('Network error. Please call 90 732 91 732.', 'er'); })
          .finally(function () {
            submitEl.disabled = false;
            if (btnTxtEl) btnTxtEl.textContent = 'Get Free Quote';
          });
      });
    }

    function showMsg(t, c) {
      if (!msgEl) return;
      msgEl.className = 'eq-msg ' + c;
      msgEl.textContent = (c === 'ok' ? '\u2713 ' : '\u26a0 ') + t;
      msgEl.style.display = 'block';
    }
    function clearMsg() {
      if (!msgEl) return;
      msgEl.className = 'eq-msg';
      msgEl.textContent = '';
      msgEl.style.display = 'none';
    }
  }

  /* ══ MOBILE NAV ══ */
  function initNav() {
    var burger  = document.getElementById('navBurger');
    var panel   = document.getElementById('navPanel');
    var backdrop= document.getElementById('navBackdrop');
    var closeBtn= document.getElementById('navPanelClose');
    if (!burger || !panel) return;

    function open() {
      panel.classList.add('open');
      panel.setAttribute('aria-hidden', 'false');
      burger.setAttribute('aria-expanded', 'true');
      if (backdrop) backdrop.classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function close() {
      panel.classList.remove('open');
      panel.setAttribute('aria-hidden', 'true');
      burger.setAttribute('aria-expanded', 'false');
      if (backdrop) backdrop.classList.remove('open');
      document.body.style.overflow = '';
    }

    burger.addEventListener('click', open);
    if (closeBtn)  closeBtn.addEventListener('click', close);
    if (backdrop)  backdrop.addEventListener('click', close);
    panel.querySelectorAll('a').forEach(function (a) { a.addEventListener('click', close); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });
  }

  /* ══ TRACKING ══ */
  function initTracking() {
    var inp = document.getElementById('trackInput');
    var btn = document.getElementById('trackBtn');
    var res = document.getElementById('trackResult');
    if (!inp || !btn) return;

    function go() {
      var v = inp.value.trim();
      if (v.length < 4) {
        if (res) { res.style.display = 'block'; res.textContent = 'Enter a valid consignment number.'; }
        return;
      }
      btn.disabled = true; btn.textContent = 'Searching...';
      var fd = new FormData();
      fd.append('action', 'ss_track');
      fd.append('nonce',  NONCE);
      fd.append('consignment', v);
      fetch(AJAX, { method: 'POST', body: fd, credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .then(function (d) {
          if (d.success && d.data.redirect) { window.location.href = d.data.redirect; }
          else if (res) { res.style.display = 'block'; res.textContent = 'Not found. Please call 90 732 91 732.'; }
        })
        .catch(function () { if (res) { res.style.display = 'block'; res.textContent = 'Network error. Call 90 732 91 732.'; }})
        .finally(function () { btn.disabled = false; btn.textContent = 'Track'; });
    }

    btn.addEventListener('click', go);
    inp.addEventListener('keydown', function (e) { if (e.key === 'Enter') go(); });
  }

  /* ══ SCROLL TOP ══ */
  function initScrollTop() {
    var btn = document.getElementById('scrollTop');
    if (!btn) return;
    window.addEventListener('scroll', function () { btn.classList.toggle('on', window.scrollY > 500); }, { passive: true });
    btn.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });
  }

  /* ══ REVEAL ══ */
  function initReveal() {
    var els = document.querySelectorAll('.reveal');
    if (!els.length) return;
    if (!('IntersectionObserver' in window)) {
      els.forEach(function (e) { e.classList.add('on'); });
      return;
    }
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add('on'); io.unobserve(en.target); }
      });
    }, { threshold: 0.08, rootMargin: '0px 0px -20px 0px' });
    els.forEach(function (el) { io.observe(el); });
  }

  /* ══ STICKY HEADER ══ */
  function initSticky() {
    var h = document.getElementById('siteHeader');
    if (!h) return;
    window.addEventListener('scroll', function () { h.classList.toggle('scrolled', window.scrollY > 10); }, { passive: true });
  }

})();
