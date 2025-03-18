<?php 
/*
 * Template Name: Ui Kit Testing
 * Template Post Type: page
 */
?>

<?php get_header(); ?>

<?php edit_link_override(get_queried_object_id()); ?>

<main class="main" id="main-content">
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) { the_post(); ?>
			
            <div class="container">
                
                <h1 class="mt-10 mb-3">Card</h1>
                <div class="row">
                    <div class="col-4">
                        <div class="card text-bg-green mb-3">
                            <img class="card-img-top" src="https://placehold.co/600x300" />
                            <div class="card-body">
                                <h4 class="card-title">Explore the Surprising Capabilities of EVV</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur. Sit facilisis purus </p>
                                <a class="btn btn-dark">Button</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-bg-off-white mb-3">
                            <img class="card-img-top" src="https://placehold.co/600x300" />    
                            <div class="card-body">
                                <h4 class="card-title">Explore the Surprising Capabilities of EVV</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur. Sit facilisis purus </p>
                                <a class="btn btn-dark">Button</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-bg-yellow mb-3">
                            <img class="card-img-top" src="https://placehold.co/600x300" />
                            <div class="card-body">
                                <h4 class="card-title">Maximizing the Benefits of Medicaid Waivers for Self-Directed Care</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur. Sit facilisis purus </p>
                                <a class="btn btn-dark">Button</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-bg-aqua mb-3">
                            <img class="card-img-top" src="https://placehold.co/600x300" />
                            <div class="card-body">
                                <h4 class="card-title">Explore the Surprising Capabilities of EVV</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur. Sit facilisis purus </p>
                                <a class="btn btn-dark">Button</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-bg-purple mb-3">
                            <img class="card-img-top" src="https://placehold.co/600x300" />    
                            <div class="card-body">
                                <h4 class="card-title">Explore the Surprising Capabilities of EVV</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur. Sit facilisis purus </p>
                                <a class="btn btn-dark">Button</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-bg-blue mb-3">
                            <img class="card-img-top" src="https://placehold.co/600x300" />
                            <div class="card-body">
                                <h4 class="card-title">Maximizing the Benefits of Medicaid Waivers for Self-Directed Care</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur. Sit facilisis purus </p>
                                <a class="btn btn-dark">Button</a>
                            </div>
                        </div>
                    </div>

                </div>


                <h1 class="mt-10 mb-3">Icon Card</h1>
                <div class="row">
                    <div class="col-6">
                        <div class="card card-flush mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/90x90" />
                           
                                <h2 class="card-title">Integrate every part of your business</h2>
                                <p class="card-text">Our Partner Connect program enables our clients to directly connect their Underwing platform with complementary, industry-leading solutions that drive efficiency and visibility. From eLearning and earned wage access, to care intelligence and health screening, Partner Connect enables you to enhance every aspect of your operations.</p>
                                <a href="#" class="btn btn-link">Optional Link</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card card-flush mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/90x90" />
                           
                                <h2 class="card-title">Maintain secure network operations and ensure member privacy</h2>
                                <p class="card-text">Security and privacy of member data is a critical requirement in the homecare industry. Underwing has numerous security and privacy certifications, a secure software development lifecycle, and advanced auditing capabilities to ensure all critical activities and events are logged.</p>
                                <a href="#" class="btn btn-link">Optional Link</a>
                            </div>
                        </div>
                    </div>

                </div>

                

                <h1 class="mt-10 mb-3">Solution Card</h1>
                <div class="row">
                    <div class="col-4">
                        <div class="card card-solution mb-3">
                            <div class="card-body">
                                
                                <img class="card-glyph" src="https://placehold.co/65x65" />
                           
                                <h3 class="card-title">Streamline intakes and referrals</h3>
                                <p class="card-text">How can you onboard new clients and caregivers more efficiently?</p>
                                <a href="#" class="link-arrow stretched-link">
                                    <span>Learn more</span><i class="icon icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-solution mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/65x65" />
                           

                                <h3 class="card-title">Schedule Caregivers</h3>
                                <p class="card-text">How can you onboard new clients and caregivers more efficiently?</p>
                                <a href="#" class="link-arrow stretched-link">
                                    <span>Learn more</span><i class="icon icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-solution mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/65x65" />
                           
                                <h3 class="card-title">Accelerate Billing</h3>
                                <p class="card-text">How can you onboard new clients and caregivers more efficiently?</p>
                                <a href="#" class="link-arrow stretched-link">
                                    <span>Learn more</span><i class="icon icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>


                <h1 class="mt-10 mb-3">Stat Card</h1>
                <div class="row justify-content-evenly">
                    <div class="col-3">
                        <div class="card card-flush card-center mb-3">
                            <img src="https://placehold.co/90x90" />
                            <div class="card-body">
                                <h3 class="card-title display-1">27B</h3>
                                <p class="card-text text-dark-green lead">Homecare services billed annually</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card card-flush card-center mb-3">
                            <img src="https://placehold.co/90x90" />
                            <div class="card-body">
                                <h3 class="card-title display-1">1.1M</h3>
                                <p class="card-text text-dark-green lead">Caregivers clocking in & out monthly</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card card-flush card-center mb-3">
                            <img src="https://placehold.co/90x90" />
                            <div class="card-body">
                                <h3 class="card-title display-1">234M</h3>
                                <p class="card-text text-dark-green lead">Visits confirmed annually</p>
                            </div>
                        </div>
                    </div>

                </div>

                <h1 class="mt-10 mb-3">Info Card</h1>
                <div class="row">
                    <div class="col-4">
                        <div class="card text-bg-green mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/72x72" />
                                <h3 class="card-title">Meet compliance requirements</h3>
                                <p class="card-text">Equip providers with the necessary tools to effectively meet federal and state compliance regulations at the caregiver and visit level.</p>
                                <a href="#" class="btn btn-link">Learn more</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-bg-off-white mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/72x72" />
                                <h3 class="card-title">Improve Outcomes</h3>
                                <p class="card-text">Deliver better care with easy-to-use tools that allow your team to focus on providing quality care.</p>
                                <a href="#" class="btn btn-link">Learn more</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-bg-yellow mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/72x72" />
                                <h3 class="card-title">Work smarter</h3>
                                <p class="card-text">Increase efficiency and grow your business by automating time-consuming tasks like billing and scheduling.</p>
                                <a href="#" class="btn btn-link">Learn more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card text-bg-aqua mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/72x72" />
                                <h3 class="card-title">Meet compliance requirements</h3>
                                <p class="card-text">Equip providers with the necessary tools to effectively meet federal and state compliance regulations at the caregiver and visit level.</p>
                                <a href="#" class="btn btn-link">Learn more</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-bg-purple mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/72x72" />
                                <h3 class="card-title">Improve Outcomes</h3>
                                <p class="card-text">Deliver better care with easy-to-use tools that allow your team to focus on providing quality care.</p>
                                <a href="#" class="btn btn-link">Learn more</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-bg-blue mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/72x72" />
                                <h3 class="card-title">Work smarter</h3>
                                <p class="card-text">Increase efficiency and grow your business by automating time-consuming tasks like billing and scheduling.</p>
                                <a href="#" class="btn btn-link">Learn more</a>
                            </div>
                        </div>
                    </div>

                </div>

                <h1 class="mt-10 mb-3">Benefit Card</h1>
                <div class="row">
                    <div class="col-4">
                        <div class="card card-center text-bg-green mb-3">
                             <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/32x32" />
                                <p class="card-title lead">Agency caregivers of Personal Care Services (PCS)</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-center text-bg-off-white mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/32x32" />
                                <p class="card-title lead">Skilled providers of Home Health Care Services (HHCS)</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-center text-bg-yellow mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/32x32" />
                                <p class="card-title lead">Direct care workers for Self-Directed services</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-center text-bg-aqua mb-3">
                             <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/32x32" />
                                <p class="card-title lead">Agency caregivers of Personal Care Services (PCS)</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-center text-bg-purple mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/32x32" />
                                <p class="card-title lead">Skilled providers of Home Health Care Services (HHCS)</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-center text-bg-blue mb-3">
                            <div class="card-body">
                                <img class="card-glyph" src="https://placehold.co/32x32" />
                                <p class="card-title lead">Direct care workers for Self-Directed services</p>
                            </div>
                        </div>
                    </div>
                </div>


               
                <h1 class="mt-10 mb-3">Client Story</h1>
                <div class="row">
                    <div class="col-10">
                        <div class="card card-horizontal text-bg-green mb-3">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <div class="card-img-left" style="background-image: url(https://placehold.co/600x400);"></div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <p class="card-pretitle">Hear from our clients</p>
                                        <h2 class="card-title">"Underwing allows my caregivers and my employees to free up extra time to do things that are important."</h2>
                                        <p class="card-text"><strong>Sofia Yagudaev</strong></p>
                                        <p class="card-text">Administrator, Boulevard Home Care</p>
                                        <a class="btn btn-link">View customer stories</a>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-cargiver"></div>
                        </div>
                    </div>

                    <div class="col-10">
                        
                        <div class="card card-horizontal text-bg-green mb-3">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <div class="card-img-left" style="background-image: url(https://placehold.co/600x400);"></div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <p class="card-pretitle">Hear from our clients</p>
                                        <h2 class="card-title">"Underwing allows my caregivers and my employees to free up extra time to do things that are important."</h2>
                                        <p class="card-text"><strong>Sofia Yagudaev</strong></p>
                                        <p class="card-text">Administrator, Boulevard Home Care</p>
                                        <a class="btn btn-link">View customer stories</a>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-cargiver"></div>
                        </div>
                       
                    </div>
                </div>


                <h1 class="mt-10 mb-3">Blog Card</h1>
                <div class="row">
                    <div class="col-4">
                        <div class="card card-flush mb-3">
                            <img src="https://placehold.co/600x400" class="img-fluid" alt="...">
                            <div class="card-body">
                                <h4 class="card-title">Explore the Surprising Capabilities of EVV </h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-flush mb-3">
                            <img src="https://placehold.co/600x400" class="img-fluid" alt="...">
                            <div class="card-body">
                                <h4 class="card-title">Maximizing the Benefits of Medicaid Waivers for Self-Directed Care </h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-flush mb-3">
                            <img src="https://placehold.co/600x400" class="img-fluid" alt="...">
                            <div class="card-body">
                                <h4 class="card-title">Advancing Our Mission to Enable the Best Care in Homes and Communities </h4>
                            </div>
                        </div>
                    </div>

                </div>


                <h1 class="mt-10 mb-3">Resource Card</h1>
                <div class="row">
                    <div class="col-4">
                        <div class="card card-flush mb-3">
                            <img src="https://placehold.co/600x400" class="img-fluid" alt="...">
                            <div class="card-body">
                                <p class="card-pretitle">CONTENT  TYPE LABEL</p>
                                <h4 class="card-title">Explore the Surprising Capabilities of EVV </h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-flush mb-3">
                            <img src="https://placehold.co/600x400" class="img-fluid" alt="...">
                            <div class="card-body">
                                <p class="card-pretitle">CONTENT  TYPE LABEL</p>
                                
                                <h4 class="card-title">Maximizing the Benefits of Medicaid Waivers for Self-Directed Care </h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card card-flush mb-3">
                            <img src="https://placehold.co/600x400" class="img-fluid" alt="...">
                            <div class="card-body">
                                <p class="card-pretitle">CONTENT  TYPE LABEL</p>
                                
                                <h4 class="card-title">Advancing Our Mission to Enable the Best Care in Homes and Communities </h4>
                            </div>
                        </div>
                    </div>

                </div>



                <h1 class="mt-10 mb-3">Profile Card</h1>
                <div class="row justify-content-evenly">
                    <div class="col-3">
                        <a class="card card-profile mb-3">
                            <img src="https://placehold.co/400x400" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Paul Joiner</h3>
                                <p class="card-text">CHIEF EXECUTIVE OFFICER</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-3">
                        <a class="card card-profile mb-3">
                            <img src="https://placehold.co/400x400" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Stephen Vaccaro</h3>
                                <p class="card-text">President</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-3">
                        <a class="card card-profile mb-3">
                            <img src="https://placehold.co/400x400" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">JC Stanton</h3>
                                <p class="card-text">Chief Financial Officer</p>
                            </div>
                        </a>
                    </div>

                </div>


                <h1 class="mt-10 mb-3">Support Card</h1>
                <div class="row">
                    <div class="col-6">
                        <div class="card text-bg-aqua mb-3">
                            <div class="card-body">
                                <h2 class="card-title">Log in</h2>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur. Sit facilisis purus </p>
                                <a href="#" class="btn btn-dark">Log in to Pavillio</a>
                            </div>
                            <img src="https://placehold.co/600x300" class="card-img-bottom" alt="...">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card text-bg-yellow mb-3">
                            <div class="card-body">
                                <h2 class="card-title">Access Support</h2>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur. Sit facilisis purus </p>
                                <a href="#" class="btn btn-dark">Get Help</a>
                            </div>
                        <img src="https://placehold.co/600x300" class="card-img-bottom" alt="...">
                        </div>
                    </div>

                </div>

            </div>
                

		<?php } ?>
	<?php } ?>
</main>

<?php get_footer(); ?>