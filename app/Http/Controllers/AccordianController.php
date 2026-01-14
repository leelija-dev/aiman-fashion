<!-- < ?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccordianController extends Controller
{
    public function uiuxBenefits()
    {
        return [
            'title' => 'Our UX/UI Design Builds ‘Brands’',
            'subtitle' => [
                'Not just designs, we craft user satisfaction',
                'At Leelija, we drive ultimate business success through increased user loyalty',
                'Our UI design UX design experts focus on increased user engagement with tailored web design solutions, customized for positive brand connections.'
            ],
            'cards_data' => [
                [
                    'header' => 'Engage Your <span class="text-primary">Audience</span>',
                    'description' => [
                        'Our UI design UX design interface is navigation-friendly, which makes it easier for your users to find what they actually need. Also, our UI/UX design services guide the users towards your desired actions, resulting in enhanced customer loyalty & improved conversions.',
                        'By adding engaging graphics & interactive visuals on your site, we ensure a personalized, seamless, & enjoyable user experience, leading to a deeper site engagement & user satisfaction. We ensure meeting the user requirements by designing accessible website interfaces.'
                    ]
                ],
                [
                    'header' => 'Improved <span class="text-primary">Brand Perception</span>',
                    'description' => [
                        'We focus on a well-designed website with unmatched UX vs UI design that is interactive, responsive, & engaging, ensuring a longer stay of your users & a positive navigation journey on your website. By creating a positive first impression on your site, we foster a deeper sense of connection with your users.',
                        'Our UI & UX designers maintain a consistent brand identity by adhering to strict typography, color palettes, & image formats for a reliable brand reputation.'
                    ]
                ],
                [
                    'header' => 'Reduced <span class="text-primary">Development Cost</span>',
                    'description' => [
                        'Our customized UI and UX design saves you expensive redesign costs after web development by identifying and addressing the potential issues earlier through analyzing user behaviors, preferences, & click patterns. This leads to faster lead generation, reduced long-term maintenance costs, and enhanced customer loyalty.',
                        'We design clear website interfaces to reduce confusion for your users. By adding intuitive visuals on your site, our designers ensure less miscommunication, site navigation gaps, & less ongoing support and design costs.'
                    ]
                ],
                [
                    'header' => 'More <span class="text-primary">Leads</span>',
                    'description' => [
                        'Improved UI UX design on your website attracts the attention of your target audience. The clear and user-friendly navigation makes your site interface way more functional, leading to more time spent on your site. By making your site visually appealing, we help you keep your users engaged for longer.',
                        'We add aesthetically pleasing visuals and attractive UI elements with strategically placed CTAs that are highly interactive. Our research-oriented and result-driven UI UX design results in enhanced site traffic.'
                    ]
                ],
                [
                    'header' => 'Improved <span class="text-primary">Credibility</span>',
                    'description' => [
                        'We are the best UI UX design agency, particularly efficient in designing a polished, responsive, and intuitive website interface that builds trust with your audience. Our UX UI web design results in reduced bounce rates on your site due to the strong and reliable brand image.',
                        'By designing easy-to-navigate websites with outstanding UI/UX visuals, we help your brand stay competitive in the crowded market and showcase a unique industry authority.'
                    ]
                ]
            ]
        ];
    }
    public function ecommerceSeoBenefits()
    {
        return [
            'title' => 'We Have Tailored E-Commerce SEO Solutions',
            'subtitle' => [
                'No Guess Work, Only Guaranteed Brand Growth',
                'At Leelija, we achieve guaranteed business growth for your e-commerce brand.',
                'Our e-commerce SEM SEO consultants focus on accurate data analysis and implementing only proven strategies to acquire desired SEO outcomes.'
            ],
            'cards_data' => [
                [
                    'header' => 'Initial <span class="text-primary">Consultation</span>',
                    'description' => [
                        'Once you get in touch with us, our SEO team for e-commerce websites will arrange for a consultation session. During this session, we will discuss your website, business objectives, and analyze the market opportunities & the growth potential in a particular industry.',
                        'Next, we will identify the target audience, track their preference, browsing patterns, and search engine queries. Depending on that, we formulate a tailored SEO strategy to focus on the key areas of improvement.'
                    ]
                ],
                [
                    'header' => 'Goal<span class="text-primary"> Setting</span>',
                    'description' => [
                        'At this stage, we will set the framework of Specific, Measurable, Achievable, Related, and Time-bound (SMART) goals to achieve. We set specific goals depending on your industry niche, target audience, and the desired business outcomes.',
                        'This ensures that all SEO efforts are aligned with your business objectives and measurable results are delivered.'
                    ]
                ],
                [
                    'header' => 'Strategy <span class="text-primary"> Outline</span>',
                    'description' => [
                        'To deliver the best eCommerce SEO service, our ecommerce SEO service experts provide you with a clear roadmap for keyword targeting, marketing campaigns, technical optimization, structuring website content, and link-building efforts.',
                        'It aligns specific SEO goals with your industry objectives to ensure measurable business growth. This structured and tailored approach ensures greater SEO success for your e-commerce business site.'
                    ]
                ],
                [
                    'header' => 'Implementation of <span class="text-primary">SEO Strategies</span>',
                    'description' => [
                        'Our ecommerce SEO service experts are passionate about boosting your sales through on-page, off-page, & technical SEO audits, content creation, and backlink building, etc.',
                        'By optimizing your overall web page content, site structure, and performance, we ensure the best user experience.',
                        'Our strategic implementation of e-commerce SEO techniques improves your site’s ranking on the SERPs, leading to increased lead generation and traffic conversion.'
                    ]
                ],
                [
                    'header' => 'Complete <span class="text-primary">SEO Audit</span>',
                    'description' => [
                        'We perform a complete SEO audit of your e-commerce website to find out the areas of improvement and crawling or indexing issues for increased website traffic and sales growth.',
                        'Our ecommerce SEM SEO consultants not only focus on improving the SEO metrics of your e-commerce business site, but also address the technical issues and identify the content gap for enhanced audience engagement and sales.'
                    ]
                ],
                [
                    'header' => 'Updates<span class="text-primary"> & Reporting</span>',
                    'description' => [
                        'We prioritize your business growth and to ensure it, we analyse your site performance regularly and modify our strategies for a comprehensive and accurate site optimization.',
                        'Our e-commerce SEO specialists are well aware of the shifting search engine algorithms and user behavior. With regular reporting and tracking, we ensure that our e-commerce SEO strategies are relevant and drive measurable brand growth.'
                    ]
                ]
            ]
        ];
    }
    public function socialMediaServices()
    {
        return [
            'title' => 'We Deliver Comprehensive Social Media Marketing Services',
            'subtitle' => [
                'No Fake Engagement, Only Long-Term Brand Growth',
                'At Leelija, we ensure consistent community engagement on relevant social media platforms.',
                'Our targeted strategies focus on tailored ad content creation, advertising management, campaign performance tracking, and faster accomplishments of business goals for increased lead generation.'
            ],
            'cards_data' => [
                [
                    'header' => 'Defining<span class="text-primary"> Goals</span>',
                    'description' => [
                        'Before we get deeper into the process of the marketing campaign, our team set Specific, Measurable, Achievable, Relevant, and Time-Bound (SMART) objectives for your business to plan our strategies accordingly. 
We aim to foster real social media engagement for your business by boosting brand awareness, qualified lead generation, and traffic conversion. 
'
                    ]
                ],
                [
                    'header' => 'Understanding<span class="text-primary"> Your </span>Audience',
                    'description' => [
                        'Fostering trust between your business and target audience is our first priority. Our team of experts crafts tailored ad content after analyzing the specific interests, needs, and preferences of your potential leads for improved engagement and real results. ',
                        'We analyze the potential user behavior, perform a thorough competitor analysis, and adopt marketing approaches based on individual buyer personas.'
                    ]
                ],
                [
                    'header' => 'Competitor <span class="text-primary">Research</span>',
                    'description' => [
                        'We analyze the key social media marketing strategy implemented by your top competitors and track their engagement rates and overall campaign performance to identify the strategic gaps, leverage the best marketing opportunities for your brand, develop powerful marketing strategies based on recent market trends, and refine them for further campaign improvements.'
                    ]
                ],
                [
                    'header' => 'Content <span class="text-primary">Plan</span> Development',
                    'description' => [
                        'After a thorough analysis of marketing trends and the target audience, we identify the best social media platforms to promote tailored business content for your brand and boost your website/business engagement.',
                        'We also focus on strategic refinements, initial campaign performance analysis, and diversification of marketing content creation for faster goal achievement.'
                    ]
                ],
                [
                    'header' => 'Executing <span class="text-primary">Marketing</span> Strategies',
                    'description' => [
                        'To be on par with the rapidly evolving social media platform algorithms and marketing trends, we focus on the strategic implementation of tailored marketing techniques for your business, designed for quick adaptation for maximized campaign effectiveness and niche relevance. ',
                        'We ensure engaging campaigns by fostering direct communication between you and your customers for improved brand reputation.'
                    ]
                ],
                [
                    'header' => 'Monitoring<span class="text-primary"> Progress</span>',
                    'description' => [
                        'At Leelija, we ensure campaign budget efficiency, improved brand reputation, and better customer relationships by tracking the real-time progress of your marketing campaigns and monitoring the Key Performance Indicators (KPIs) like engagement rate and conversions of traffic.',
                        'Our marketing professionals optimize the campaign performance for effective brand reputation management and a competitive edge.'
                    ]
                ]
            ]
        ];
    }


    public function SeoWhychoseUs()
    {
        return [
            'title' => 'Why Choose Leelija As Your Trusted SEO Partner?',
            'subtitle' => [
                ''
            ],
            'cards_data' => [
                [
                    'header' => 'Proven <span class="text-primary">Industry Expertise</span>',
                    'description' => [
                        'With over 6+ years of experience in SEO and digital marketing, we have achieved great results for our clients’ websites. Our case studies and client testimonials showcase our deep understanding of the business industries and professional expertise in improving your site’s SEO rankings and online visibility.'
                    ]
                ],
                [
                    'header' => 'Data-Driven <span class="text-primary">Approach</span>',
                    'description' => [
                        'At Leelija, we aim to deliver guaranteed SEO growth for your e-commerce business.',
                        'Our SEO professionals are dedicated site optimization experts who implement the best data-driven strategies.',
                        'By using advanced automated tools & technologies and tracking various SEO site metrics, we ensure optimum and sustainable business growth.'
                    ]
                ],
                [
                    'header' => 'More <span class="text-primary">Traffic and Conversions</span>',
                    'description' => [
                        'By performing an overall SEO audit for your website with great content and actionable keywords, our SEO experts design a user-friendly website for faster and easier navigation. We constantly work towards establishing your business as a reputed, authoritative, and credible brand in the digital landscape by building trust.'
                    ]
                ],
                [
                    'header' => 'Improved <span class="text-primary">Sales</span>',
                    'description' => [
                        'Our site optimization techniques are proven & result-driven strategies based on thorough market research and data analysis. We implement tailored SEO strategies to improve your brand’s online presence and attract qualified leads for increased sales.'
                    ]
                ],
                [
                    'header' => 'Faster <span class="text-primary">Brand Growth</span>',
                    'description' => [
                        'By increasing your site’s online visibility through valuable content creation, site optimization, and leveraging popular social media platforms, we ensure the best SEO rankings for your site. Our comprehensive services address all website SEO aspects for increased brand authority, niche credibility, and lead generation, leading to sustainable brand growth.'
                    ]
                ]
            ]
        ];
    }
    public function OnlineWhychoseUs()
    {
        return [
            'title' => 'Why Choose Leelija As Your Trusted Marketing Partner?',
            'subtitle' => [
                ''
            ],
            'cards_data' => [
                [
                    'header' => 'Proven <span class="text-primary">Track Record</span>',
                    'description' => [
                        'With more than 6 + years of experience in online branding and marketing, we have been conducting the most effective advertising campaigns for our clients, resulting in unmatched business outcomes.'
                    ]
                ],
                [
                    'header' => 'Transparent <span class="text-primary">Communication </span>',
                    'description' => [
                        'Our skilled marketing experts are always up for open communication, real-time updates about campaign progress, and strategic reformation based on performance for added transparency and honesty. '
                    ]
                ],
                [
                    'header' => 'Efficient<span class="text-primary"> Team Members</span>',
                    'description' => [
                        'The professionals at our agency are skilled marketing experts with unbeatable knowledge in navigating the complex marketing landscape of consumerism through buyers’ trend analysis and command over the latest tools and technologies.'
                    ]
                ],
                [
                    'header' => 'Creative<span class="text-primary"> Innovation </span>',
                    'description' => [
                        'As a trusted consultant marketing online agency, we always focus on developing innovative online marketing ideas to capture the attention of your target leads, overcome industry challenges, and make your brand stand out among the crowd.'
                    ]
                ],
                [
                    'header' => 'Client-Centric <span class="text-primary">& Problem-Solving Approach</span>',
                    'description' => [
                        'We prioritize your business goals. That is why our marketing experts work as your strategic branding and advertising partner for flawless campaign execution while turning creative efforts into successful lead conversion.'
                    ]
                ]
            ]
        ];
    }
    public function DesignWhychoseUs()
    {
        return [
            'title' => 'Why Is Leelija Your Trusted Web Design Company?',
            'subtitle' => [
                ''
            ],
            'cards_data' => [
                [
                    'header' => 'Industry <span class="text-primary">Knowledge & Expertise</span>',
                    'description' => [
                        'We have 7+ years of proven expertise in designing attractive website designs that perfectly align with the current industry trends, regulations, & business goals for enhanced audience engagement. By designing adaptive & responsive websites for your business, we ensure improved functionality, easy accessibility, and enhanced conversion on your site.'
                    ]
                ],
                [
                    'header' => 'Transparency & <span class="text-primary">Clear Communication</span>',
                    'description' => [
                        'Our professionals encourage clear discussions about project timelines, web design strategies, procedures, and pricing options that showcase our commitment to your ultimate satisfaction. We understand your specific business needs and adapt a personalized & specific approach to design websites accordingly for a targeted outcome.'
                    ]
                ],
                [
                    'header' => 'User-Centered & <span class="text-primary">Customized Design</span>',
                    'description' => [
                        'We create user-oriented websites that are intuitive, navigational, adaptive across all devices, and designed to meet your specific needs and preferences. By designing responsive & customized web designs, we help you create a positive brand image, resulting in increased user engagement, traffic retention, and lead conversion.'
                    ]
                ],
                [
                    'header' => 'Mobile-first & <span class="text-primary">Result-Oriented Approach</span>',
                    'description' => [
                        'For faster website optimization and wider user engagement, we prioritize a mobile-friendly & responsive web design. Our web designs are meant for meeting specific business objectives, such as generating leads, improving sales, or simply drawing the attention of your audience to provide them with relevant user values.'
                    ]
                ],
                [
                    'header' => 'Continuous <span class="text-primary">Support & Maintenance</span>',
                    'description' => [
                        'We provide you with ongoing support and website maintenance services to ensure improved site functionality & robust security for the best user experience, ultimate satisfaction, and lead generation. We make sure that your website is up to the latest trends, optimized for search engines, & protected from bugs and technical malfunctions.'
                    ]
                ]
            ]
        ];
    }
} -->
