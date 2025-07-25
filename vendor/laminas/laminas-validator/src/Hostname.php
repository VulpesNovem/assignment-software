<?php // phpcs:disable Generic.Files.LineLength.TooLong

namespace Laminas\Validator;

use Laminas\Stdlib\StringUtils;

use function array_key_exists;
use function array_pop;
use function array_shift;
use function chr;
use function count;
use function end;
use function explode;
use function func_get_args;
use function implode;
use function in_array;
use function intval;
use function is_array;
use function is_string;
use function ord;
use function preg_match;
use function prev;
use function reset;
use function str_contains;
use function str_ends_with;
use function str_starts_with;
use function strlen;
use function strrpos;
use function strtolower;
use function strtoupper;
use function substr;

/**
 * Please note there are two standalone test scripts for testing IDN characters due to problems
 * with file encoding.
 *
 * The first is tests/Laminas/Validator/HostnameTestStandalone.php which is designed to be run on
 * the command line.
 *
 * The second is tests/Laminas/Validator/HostnameTestForm.php which is designed to be run via HTML
 * to allow users to test entering UTF-8 characters in a form.
 *
 * @psalm-type Options = array{
 *    allow?: int-mask-of<self::ALLOW_*>,
 *    useIdnCheck?: bool,
 *    useTldCheck?: bool,
 *    ipValidator?: null|ValidatorInterface,
 * }
 * @final
 */
class Hostname extends AbstractValidator
{
    public const CANNOT_DECODE_PUNYCODE  = 'hostnameCannotDecodePunycode';
    public const INVALID                 = 'hostnameInvalid';
    public const INVALID_DASH            = 'hostnameDashCharacter';
    public const INVALID_HOSTNAME        = 'hostnameInvalidHostname';
    public const INVALID_HOSTNAME_SCHEMA = 'hostnameInvalidHostnameSchema';
    public const INVALID_LOCAL_NAME      = 'hostnameInvalidLocalName';
    public const INVALID_URI             = 'hostnameInvalidUri';
    public const IP_ADDRESS_NOT_ALLOWED  = 'hostnameIpAddressNotAllowed';
    public const LOCAL_NAME_NOT_ALLOWED  = 'hostnameLocalNameNotAllowed';
    public const UNDECIPHERABLE_TLD      = 'hostnameUndecipherableTld';
    public const UNKNOWN_TLD             = 'hostnameUnknownTld';

    /** @var array */
    protected $messageTemplates = [
        self::CANNOT_DECODE_PUNYCODE  => "The input appears to be a DNS hostname but the given punycode notation cannot be decoded",
        self::INVALID                 => "Invalid type given. String expected",
        self::INVALID_DASH            => "The input appears to be a DNS hostname but contains a dash in an invalid position",
        self::INVALID_HOSTNAME        => "The input does not match the expected structure for a DNS hostname",
        self::INVALID_HOSTNAME_SCHEMA => "The input appears to be a DNS hostname but cannot match against hostname schema for TLD '%tld%'",
        self::INVALID_LOCAL_NAME      => "The input does not appear to be a valid local network name",
        self::INVALID_URI             => "The input does not appear to be a valid URI hostname",
        self::IP_ADDRESS_NOT_ALLOWED  => "The input appears to be an IP address, but IP addresses are not allowed",
        self::LOCAL_NAME_NOT_ALLOWED  => "The input appears to be a local network name but local network names are not allowed",
        self::UNDECIPHERABLE_TLD      => "The input appears to be a DNS hostname but cannot extract TLD part",
        self::UNKNOWN_TLD             => "The input appears to be a DNS hostname but cannot match TLD against known list",
    ];

    /** @var array */
    protected $messageVariables = [
        'tld' => 'tld',
    ];

    public const ALLOW_DNS   = 1;  // Allows Internet domain names (e.g., example.com)
    public const ALLOW_IP    = 2;  // Allows IP addresses
    public const ALLOW_LOCAL = 4;  // Allows local network names (e.g., localhost, www.localdomain)
    public const ALLOW_URI   = 8;  // Allows URI hostnames
    public const ALLOW_ALL   = 15;  // Allows all types of hostnames

    /**
     * Array of valid top-level-domains
     *
     * @see ftp://data.iana.org/TLD/tlds-alpha-by-domain.txt  List of all TLDs by domain
     * @see http://www.iana.org/domains/root/db/ Official list of supported TLDs
     *
     * @var string[]
     */
    protected $validTlds = [
        'aaa',
        'aarp',
        'abb',
        'abbott',
        'abbvie',
        'abc',
        'able',
        'abogado',
        'abudhabi',
        'ac',
        'academy',
        'accenture',
        'accountant',
        'accountants',
        'aco',
        'actor',
        'ad',
        'ads',
        'adult',
        'ae',
        'aeg',
        'aero',
        'aetna',
        'af',
        'afl',
        'africa',
        'ag',
        'agakhan',
        'agency',
        'ai',
        'aig',
        'airbus',
        'airforce',
        'airtel',
        'akdn',
        'al',
        'alibaba',
        'alipay',
        'allfinanz',
        'allstate',
        'ally',
        'alsace',
        'alstom',
        'am',
        'amazon',
        'americanexpress',
        'americanfamily',
        'amex',
        'amfam',
        'amica',
        'amsterdam',
        'analytics',
        'android',
        'anquan',
        'anz',
        'ao',
        'aol',
        'apartments',
        'app',
        'apple',
        'aq',
        'aquarelle',
        'ar',
        'arab',
        'aramco',
        'archi',
        'army',
        'arpa',
        'art',
        'arte',
        'as',
        'asda',
        'asia',
        'associates',
        'at',
        'athleta',
        'attorney',
        'au',
        'auction',
        'audi',
        'audible',
        'audio',
        'auspost',
        'author',
        'auto',
        'autos',
        'aw',
        'aws',
        'ax',
        'axa',
        'az',
        'azure',
        'ba',
        'baby',
        'baidu',
        'banamex',
        'band',
        'bank',
        'bar',
        'barcelona',
        'barclaycard',
        'barclays',
        'barefoot',
        'bargains',
        'baseball',
        'basketball',
        'bauhaus',
        'bayern',
        'bb',
        'bbc',
        'bbt',
        'bbva',
        'bcg',
        'bcn',
        'bd',
        'be',
        'beats',
        'beauty',
        'beer',
        'bentley',
        'berlin',
        'best',
        'bestbuy',
        'bet',
        'bf',
        'bg',
        'bh',
        'bharti',
        'bi',
        'bible',
        'bid',
        'bike',
        'bing',
        'bingo',
        'bio',
        'biz',
        'bj',
        'black',
        'blackfriday',
        'blockbuster',
        'blog',
        'bloomberg',
        'blue',
        'bm',
        'bms',
        'bmw',
        'bn',
        'bnpparibas',
        'bo',
        'boats',
        'boehringer',
        'bofa',
        'bom',
        'bond',
        'boo',
        'book',
        'booking',
        'bosch',
        'bostik',
        'boston',
        'bot',
        'boutique',
        'box',
        'br',
        'bradesco',
        'bridgestone',
        'broadway',
        'broker',
        'brother',
        'brussels',
        'bs',
        'bt',
        'build',
        'builders',
        'business',
        'buy',
        'buzz',
        'bv',
        'bw',
        'by',
        'bz',
        'bzh',
        'ca',
        'cab',
        'cafe',
        'cal',
        'call',
        'calvinklein',
        'cam',
        'camera',
        'camp',
        'canon',
        'capetown',
        'capital',
        'capitalone',
        'car',
        'caravan',
        'cards',
        'care',
        'career',
        'careers',
        'cars',
        'casa',
        'case',
        'cash',
        'casino',
        'cat',
        'catering',
        'catholic',
        'cba',
        'cbn',
        'cbre',
        'cc',
        'cd',
        'center',
        'ceo',
        'cern',
        'cf',
        'cfa',
        'cfd',
        'cg',
        'ch',
        'chanel',
        'channel',
        'charity',
        'chase',
        'chat',
        'cheap',
        'chintai',
        'christmas',
        'chrome',
        'church',
        'ci',
        'cipriani',
        'circle',
        'cisco',
        'citadel',
        'citi',
        'citic',
        'city',
        'ck',
        'cl',
        'claims',
        'cleaning',
        'click',
        'clinic',
        'clinique',
        'clothing',
        'cloud',
        'club',
        'clubmed',
        'cm',
        'cn',
        'co',
        'coach',
        'codes',
        'coffee',
        'college',
        'cologne',
        'com',
        'commbank',
        'community',
        'company',
        'compare',
        'computer',
        'comsec',
        'condos',
        'construction',
        'consulting',
        'contact',
        'contractors',
        'cooking',
        'cool',
        'coop',
        'corsica',
        'country',
        'coupon',
        'coupons',
        'courses',
        'cpa',
        'cr',
        'credit',
        'creditcard',
        'creditunion',
        'cricket',
        'crown',
        'crs',
        'cruise',
        'cruises',
        'cu',
        'cuisinella',
        'cv',
        'cw',
        'cx',
        'cy',
        'cymru',
        'cyou',
        'cz',
        'dabur',
        'dad',
        'dance',
        'data',
        'date',
        'dating',
        'datsun',
        'day',
        'dclk',
        'dds',
        'de',
        'deal',
        'dealer',
        'deals',
        'degree',
        'delivery',
        'dell',
        'deloitte',
        'delta',
        'democrat',
        'dental',
        'dentist',
        'desi',
        'design',
        'dev',
        'dhl',
        'diamonds',
        'diet',
        'digital',
        'direct',
        'directory',
        'discount',
        'discover',
        'dish',
        'diy',
        'dj',
        'dk',
        'dm',
        'dnp',
        'do',
        'docs',
        'doctor',
        'dog',
        'domains',
        'dot',
        'download',
        'drive',
        'dtv',
        'dubai',
        'dunlop',
        'dupont',
        'durban',
        'dvag',
        'dvr',
        'dz',
        'earth',
        'eat',
        'ec',
        'eco',
        'edeka',
        'edu',
        'education',
        'ee',
        'eg',
        'email',
        'emerck',
        'energy',
        'engineer',
        'engineering',
        'enterprises',
        'epson',
        'equipment',
        'er',
        'ericsson',
        'erni',
        'es',
        'esq',
        'estate',
        'et',
        'eu',
        'eurovision',
        'eus',
        'events',
        'exchange',
        'expert',
        'exposed',
        'express',
        'extraspace',
        'fage',
        'fail',
        'fairwinds',
        'faith',
        'family',
        'fan',
        'fans',
        'farm',
        'farmers',
        'fashion',
        'fast',
        'fedex',
        'feedback',
        'ferrari',
        'ferrero',
        'fi',
        'fidelity',
        'fido',
        'film',
        'final',
        'finance',
        'financial',
        'fire',
        'firestone',
        'firmdale',
        'fish',
        'fishing',
        'fit',
        'fitness',
        'fj',
        'fk',
        'flickr',
        'flights',
        'flir',
        'florist',
        'flowers',
        'fly',
        'fm',
        'fo',
        'foo',
        'food',
        'football',
        'ford',
        'forex',
        'forsale',
        'forum',
        'foundation',
        'fox',
        'fr',
        'free',
        'fresenius',
        'frl',
        'frogans',
        'frontier',
        'ftr',
        'fujitsu',
        'fun',
        'fund',
        'furniture',
        'futbol',
        'fyi',
        'ga',
        'gal',
        'gallery',
        'gallo',
        'gallup',
        'game',
        'games',
        'gap',
        'garden',
        'gay',
        'gb',
        'gbiz',
        'gd',
        'gdn',
        'ge',
        'gea',
        'gent',
        'genting',
        'george',
        'gf',
        'gg',
        'ggee',
        'gh',
        'gi',
        'gift',
        'gifts',
        'gives',
        'giving',
        'gl',
        'glass',
        'gle',
        'global',
        'globo',
        'gm',
        'gmail',
        'gmbh',
        'gmo',
        'gmx',
        'gn',
        'godaddy',
        'gold',
        'goldpoint',
        'golf',
        'goo',
        'goodyear',
        'goog',
        'google',
        'gop',
        'got',
        'gov',
        'gp',
        'gq',
        'gr',
        'grainger',
        'graphics',
        'gratis',
        'green',
        'gripe',
        'grocery',
        'group',
        'gs',
        'gt',
        'gu',
        'gucci',
        'guge',
        'guide',
        'guitars',
        'guru',
        'gw',
        'gy',
        'hair',
        'hamburg',
        'hangout',
        'haus',
        'hbo',
        'hdfc',
        'hdfcbank',
        'health',
        'healthcare',
        'help',
        'helsinki',
        'here',
        'hermes',
        'hiphop',
        'hisamitsu',
        'hitachi',
        'hiv',
        'hk',
        'hkt',
        'hm',
        'hn',
        'hockey',
        'holdings',
        'holiday',
        'homedepot',
        'homegoods',
        'homes',
        'homesense',
        'honda',
        'horse',
        'hospital',
        'host',
        'hosting',
        'hot',
        'hotels',
        'hotmail',
        'house',
        'how',
        'hr',
        'hsbc',
        'ht',
        'hu',
        'hughes',
        'hyatt',
        'hyundai',
        'ibm',
        'icbc',
        'ice',
        'icu',
        'id',
        'ie',
        'ieee',
        'ifm',
        'ikano',
        'il',
        'im',
        'imamat',
        'imdb',
        'immo',
        'immobilien',
        'in',
        'inc',
        'industries',
        'infiniti',
        'info',
        'ing',
        'ink',
        'institute',
        'insurance',
        'insure',
        'int',
        'international',
        'intuit',
        'investments',
        'io',
        'ipiranga',
        'iq',
        'ir',
        'irish',
        'is',
        'ismaili',
        'ist',
        'istanbul',
        'it',
        'itau',
        'itv',
        'jaguar',
        'java',
        'jcb',
        'je',
        'jeep',
        'jetzt',
        'jewelry',
        'jio',
        'jll',
        'jm',
        'jmp',
        'jnj',
        'jo',
        'jobs',
        'joburg',
        'jot',
        'joy',
        'jp',
        'jpmorgan',
        'jprs',
        'juegos',
        'juniper',
        'kaufen',
        'kddi',
        'ke',
        'kerryhotels',
        'kerrylogistics',
        'kerryproperties',
        'kfh',
        'kg',
        'kh',
        'ki',
        'kia',
        'kids',
        'kim',
        'kindle',
        'kitchen',
        'kiwi',
        'km',
        'kn',
        'koeln',
        'komatsu',
        'kosher',
        'kp',
        'kpmg',
        'kpn',
        'kr',
        'krd',
        'kred',
        'kuokgroup',
        'kw',
        'ky',
        'kyoto',
        'kz',
        'la',
        'lacaixa',
        'lamborghini',
        'lamer',
        'lancaster',
        'land',
        'landrover',
        'lanxess',
        'lasalle',
        'lat',
        'latino',
        'latrobe',
        'law',
        'lawyer',
        'lb',
        'lc',
        'lds',
        'lease',
        'leclerc',
        'lefrak',
        'legal',
        'lego',
        'lexus',
        'lgbt',
        'li',
        'lidl',
        'life',
        'lifeinsurance',
        'lifestyle',
        'lighting',
        'like',
        'lilly',
        'limited',
        'limo',
        'lincoln',
        'link',
        'lipsy',
        'live',
        'living',
        'lk',
        'llc',
        'llp',
        'loan',
        'loans',
        'locker',
        'locus',
        'lol',
        'london',
        'lotte',
        'lotto',
        'love',
        'lpl',
        'lplfinancial',
        'lr',
        'ls',
        'lt',
        'ltd',
        'ltda',
        'lu',
        'lundbeck',
        'luxe',
        'luxury',
        'lv',
        'ly',
        'ma',
        'madrid',
        'maif',
        'maison',
        'makeup',
        'man',
        'management',
        'mango',
        'map',
        'market',
        'marketing',
        'markets',
        'marriott',
        'marshalls',
        'mattel',
        'mba',
        'mc',
        'mckinsey',
        'md',
        'me',
        'med',
        'media',
        'meet',
        'melbourne',
        'meme',
        'memorial',
        'men',
        'menu',
        'merckmsd',
        'mg',
        'mh',
        'miami',
        'microsoft',
        'mil',
        'mini',
        'mint',
        'mit',
        'mitsubishi',
        'mk',
        'ml',
        'mlb',
        'mls',
        'mm',
        'mma',
        'mn',
        'mo',
        'mobi',
        'mobile',
        'moda',
        'moe',
        'moi',
        'mom',
        'monash',
        'money',
        'monster',
        'mormon',
        'mortgage',
        'moscow',
        'moto',
        'motorcycles',
        'mov',
        'movie',
        'mp',
        'mq',
        'mr',
        'ms',
        'msd',
        'mt',
        'mtn',
        'mtr',
        'mu',
        'museum',
        'music',
        'mv',
        'mw',
        'mx',
        'my',
        'mz',
        'na',
        'nab',
        'nagoya',
        'name',
        'navy',
        'nba',
        'nc',
        'ne',
        'nec',
        'net',
        'netbank',
        'netflix',
        'network',
        'neustar',
        'new',
        'news',
        'next',
        'nextdirect',
        'nexus',
        'nf',
        'nfl',
        'ng',
        'ngo',
        'nhk',
        'ni',
        'nico',
        'nike',
        'nikon',
        'ninja',
        'nissan',
        'nissay',
        'nl',
        'no',
        'nokia',
        'norton',
        'now',
        'nowruz',
        'nowtv',
        'np',
        'nr',
        'nra',
        'nrw',
        'ntt',
        'nu',
        'nyc',
        'nz',
        'obi',
        'observer',
        'office',
        'okinawa',
        'olayan',
        'olayangroup',
        'ollo',
        'om',
        'omega',
        'one',
        'ong',
        'onl',
        'online',
        'ooo',
        'open',
        'oracle',
        'orange',
        'org',
        'organic',
        'origins',
        'osaka',
        'otsuka',
        'ott',
        'ovh',
        'pa',
        'page',
        'panasonic',
        'paris',
        'pars',
        'partners',
        'parts',
        'party',
        'pay',
        'pccw',
        'pe',
        'pet',
        'pf',
        'pfizer',
        'pg',
        'ph',
        'pharmacy',
        'phd',
        'philips',
        'phone',
        'photo',
        'photography',
        'photos',
        'physio',
        'pics',
        'pictet',
        'pictures',
        'pid',
        'pin',
        'ping',
        'pink',
        'pioneer',
        'pizza',
        'pk',
        'pl',
        'place',
        'play',
        'playstation',
        'plumbing',
        'plus',
        'pm',
        'pn',
        'pnc',
        'pohl',
        'poker',
        'politie',
        'porn',
        'post',
        'pr',
        'pramerica',
        'praxi',
        'press',
        'prime',
        'pro',
        'prod',
        'productions',
        'prof',
        'progressive',
        'promo',
        'properties',
        'property',
        'protection',
        'pru',
        'prudential',
        'ps',
        'pt',
        'pub',
        'pw',
        'pwc',
        'py',
        'qa',
        'qpon',
        'quebec',
        'quest',
        'racing',
        'radio',
        're',
        'read',
        'realestate',
        'realtor',
        'realty',
        'recipes',
        'red',
        'redstone',
        'redumbrella',
        'rehab',
        'reise',
        'reisen',
        'reit',
        'reliance',
        'ren',
        'rent',
        'rentals',
        'repair',
        'report',
        'republican',
        'rest',
        'restaurant',
        'review',
        'reviews',
        'rexroth',
        'rich',
        'richardli',
        'ricoh',
        'ril',
        'rio',
        'rip',
        'ro',
        'rocks',
        'rodeo',
        'rogers',
        'room',
        'rs',
        'rsvp',
        'ru',
        'rugby',
        'ruhr',
        'run',
        'rw',
        'rwe',
        'ryukyu',
        'sa',
        'saarland',
        'safe',
        'safety',
        'sakura',
        'sale',
        'salon',
        'samsclub',
        'samsung',
        'sandvik',
        'sandvikcoromant',
        'sanofi',
        'sap',
        'sarl',
        'sas',
        'save',
        'saxo',
        'sb',
        'sbi',
        'sbs',
        'sc',
        'scb',
        'schaeffler',
        'schmidt',
        'scholarships',
        'school',
        'schule',
        'schwarz',
        'science',
        'scot',
        'sd',
        'se',
        'search',
        'seat',
        'secure',
        'security',
        'seek',
        'select',
        'sener',
        'services',
        'seven',
        'sew',
        'sex',
        'sexy',
        'sfr',
        'sg',
        'sh',
        'shangrila',
        'sharp',
        'shell',
        'shia',
        'shiksha',
        'shoes',
        'shop',
        'shopping',
        'shouji',
        'show',
        'si',
        'silk',
        'sina',
        'singles',
        'site',
        'sj',
        'sk',
        'ski',
        'skin',
        'sky',
        'skype',
        'sl',
        'sling',
        'sm',
        'smart',
        'smile',
        'sn',
        'sncf',
        'so',
        'soccer',
        'social',
        'softbank',
        'software',
        'sohu',
        'solar',
        'solutions',
        'song',
        'sony',
        'soy',
        'spa',
        'space',
        'sport',
        'spot',
        'sr',
        'srl',
        'ss',
        'st',
        'stada',
        'staples',
        'star',
        'statebank',
        'statefarm',
        'stc',
        'stcgroup',
        'stockholm',
        'storage',
        'store',
        'stream',
        'studio',
        'study',
        'style',
        'su',
        'sucks',
        'supplies',
        'supply',
        'support',
        'surf',
        'surgery',
        'suzuki',
        'sv',
        'swatch',
        'swiss',
        'sx',
        'sy',
        'sydney',
        'systems',
        'sz',
        'tab',
        'taipei',
        'talk',
        'taobao',
        'target',
        'tatamotors',
        'tatar',
        'tattoo',
        'tax',
        'taxi',
        'tc',
        'tci',
        'td',
        'tdk',
        'team',
        'tech',
        'technology',
        'tel',
        'temasek',
        'tennis',
        'teva',
        'tf',
        'tg',
        'th',
        'thd',
        'theater',
        'theatre',
        'tiaa',
        'tickets',
        'tienda',
        'tips',
        'tires',
        'tirol',
        'tj',
        'tjmaxx',
        'tjx',
        'tk',
        'tkmaxx',
        'tl',
        'tm',
        'tmall',
        'tn',
        'to',
        'today',
        'tokyo',
        'tools',
        'top',
        'toray',
        'toshiba',
        'total',
        'tours',
        'town',
        'toyota',
        'toys',
        'tr',
        'trade',
        'trading',
        'training',
        'travel',
        'travelers',
        'travelersinsurance',
        'trust',
        'trv',
        'tt',
        'tube',
        'tui',
        'tunes',
        'tushu',
        'tv',
        'tvs',
        'tw',
        'tz',
        'ua',
        'ubank',
        'ubs',
        'ug',
        'uk',
        'unicom',
        'university',
        'uno',
        'uol',
        'ups',
        'us',
        'uy',
        'uz',
        'va',
        'vacations',
        'vana',
        'vanguard',
        'vc',
        've',
        'vegas',
        'ventures',
        'verisign',
        'versicherung',
        'vet',
        'vg',
        'vi',
        'viajes',
        'video',
        'vig',
        'viking',
        'villas',
        'vin',
        'vip',
        'virgin',
        'visa',
        'vision',
        'viva',
        'vivo',
        'vlaanderen',
        'vn',
        'vodka',
        'volvo',
        'vote',
        'voting',
        'voto',
        'voyage',
        'vu',
        'wales',
        'walmart',
        'walter',
        'wang',
        'wanggou',
        'watch',
        'watches',
        'weather',
        'weatherchannel',
        'webcam',
        'weber',
        'website',
        'wed',
        'wedding',
        'weibo',
        'weir',
        'wf',
        'whoswho',
        'wien',
        'wiki',
        'williamhill',
        'win',
        'windows',
        'wine',
        'winners',
        'wme',
        'wolterskluwer',
        'woodside',
        'work',
        'works',
        'world',
        'wow',
        'ws',
        'wtc',
        'wtf',
        'xbox',
        'xerox',
        'xihuan',
        'xin',
        'कॉम',
        'セール',
        '佛山',
        'ಭಾರತ',
        '慈善',
        '集团',
        '在线',
        '한국',
        'ଭାରତ',
        '点看',
        'คอม',
        'ভাৰত',
        'ভারত',
        '八卦',
        'ישראל',
        'موقع',
        'বাংলা',
        '公益',
        '公司',
        '香格里拉',
        '网站',
        '移动',
        '我爱你',
        'москва',
        'қаз',
        'католик',
        'онлайн',
        'сайт',
        '联通',
        'срб',
        'бг',
        'бел',
        'קום',
        '时尚',
        '微博',
        '淡马锡',
        'ファッション',
        'орг',
        'नेट',
        'ストア',
        'アマゾン',
        '삼성',
        'சிங்கப்பூர்',
        '商标',
        '商店',
        '商城',
        'дети',
        'мкд',
        'ею',
        'ポイント',
        '新闻',
        '家電',
        'كوم',
        '中文网',
        '中信',
        '中国',
        '中國',
        '娱乐',
        '谷歌',
        'భారత్',
        'ලංකා',
        '電訊盈科',
        '购物',
        'クラウド',
        'ભારત',
        '通販',
        'भारतम्',
        'भारत',
        'भारोत',
        '网店',
        'संगठन',
        '餐厅',
        '网络',
        'ком',
        'укр',
        '香港',
        '亚马逊',
        '食品',
        '飞利浦',
        '台湾',
        '台灣',
        '手机',
        'мон',
        'الجزائر',
        'عمان',
        'ارامكو',
        'ایران',
        'العليان',
        'امارات',
        'بازار',
        'موريتانيا',
        'پاکستان',
        'الاردن',
        'بارت',
        'بھارت',
        'المغرب',
        'ابوظبي',
        'البحرين',
        'السعودية',
        'ڀارت',
        'كاثوليك',
        'سودان',
        'همراه',
        'عراق',
        'مليسيا',
        '澳門',
        '닷컴',
        '政府',
        'شبكة',
        'بيتك',
        'عرب',
        'გე',
        '机构',
        '组织机构',
        '健康',
        'ไทย',
        'سورية',
        '招聘',
        'рус',
        'рф',
        'تونس',
        '大拿',
        'ລາວ',
        'みんな',
        'グーグル',
        'ευ',
        'ελ',
        '世界',
        '書籍',
        'ഭാരതം',
        'ਭਾਰਤ',
        '网址',
        '닷넷',
        'コム',
        '天主教',
        '游戏',
        'vermögensberater',
        'vermögensberatung',
        '企业',
        '信息',
        '嘉里大酒店',
        '嘉里',
        'مصر',
        'قطر',
        '广东',
        'இலங்கை',
        'இந்தியா',
        'հայ',
        '新加坡',
        'فلسطين',
        '政务',
        'xxx',
        'xyz',
        'yachts',
        'yahoo',
        'yamaxun',
        'yandex',
        'ye',
        'yodobashi',
        'yoga',
        'yokohama',
        'you',
        'youtube',
        'yt',
        'yun',
        'za',
        'zappos',
        'zara',
        'zero',
        'zip',
        'zm',
        'zone',
        'zuerich',
        'zw',
    ];

    /**
     * Array for valid Idns
     *
     * @see http://www.iana.org/domains/idn-tables/ Official list of supported IDN Chars
     * (.AC) Ascension Island http://www.nic.ac/pdf/AC-IDN-Policy.pdf
     * (.AR) Argentina http://www.nic.ar/faqidn.html
     * (.AS) American Samoa http://www.nic.as/idn/chars.cfm
     * (.AT) Austria http://www.nic.at/en/service/technical_information/idn/charset_converter/
     * (.BIZ) International http://www.iana.org/domains/idn-tables/
     * (.BR) Brazil http://registro.br/faq/faq6.html
     * (.BV) Bouvett Island http://www.norid.no/domeneregistrering/idn/idn_nyetegn.en.html
     * (.CAT) Catalan http://www.iana.org/domains/idn-tables/tables/cat_ca_1.0.html
     * (.CH) Switzerland https://nic.switch.ch/reg/ocView.action?res=EF6GW2JBPVTG67DLNIQXU234MN6SC33JNQQGI7L6#anhang1
     * (.CL) Chile http://www.iana.org/domains/idn-tables/tables/cl_latn_1.0.html
     * (.COM) International http://www.verisign.com/information-services/naming-services/internationalized-domain-names/index.html
     * (.DE) Germany https://www.denic.de/en/know-how/idn-domains/idn-character-list/
     * (.DK) Danmark http://www.dk-hostmaster.dk/index.php?id=151
     * (.EE) Estonia https://www.iana.org/domains/idn-tables/tables/pl_et-pl_1.0.html
     * (.ES) Spain https://www.nic.es/media/2008-05/1210147705287.pdf
     * (.FI) Finland http://www.ficora.fi/en/index/palvelut/fiverkkotunnukset/aakkostenkaytto.html
     * (.GR) Greece https://grweb.ics.forth.gr/CharacterTable1_en.jsp
     * (.HR) Croatia https://www.dns.hr/en/portal/files/Odluka-1,2alfanum-dijak.pdf
     * (.HU) Hungary http://www.domain.hu/domain/English/szabalyzat/szabalyzat.html
     * (.IL) Israel http://www.isoc.org.il/domains/il-domain-rules.html
     * (.INFO) International http://www.nic.info/info/idn
     * (.IO) British Indian Ocean Territory http://www.nic.io/IO-IDN-Policy.pdf
     * (.IR) Iran http://www.nic.ir/Allowable_Characters_dot-iran
     * (.IS) Iceland https://www.isnic.is/en/domain/rules#2
     * (.KR) Korea http://www.iana.org/domains/idn-tables/tables/kr_ko-kr_1.0.html
     * (.LI) Liechtenstein https://nic.switch.ch/reg/ocView.action?res=EF6GW2JBPVTG67DLNIQXU234MN6SC33JNQQGI7L6#anhang1
     * (.LT) Lithuania http://www.domreg.lt/static/doc/public/idn_symbols-en.pdf
     * (.MD) Moldova http://www.register.md/
     * (.MUSEUM) International http://www.iana.org/domains/idn-tables/tables/museum_latn_1.0.html
     * (.NET) International http://www.verisign.com/information-services/naming-services/internationalized-domain-names/index.html
     * (.NO) Norway http://www.norid.no/domeneregistrering/idn/idn_nyetegn.en.html
     * (.NU) Niue http://www.worldnames.net/
     * (.ORG) International http://www.pir.org/index.php?db=content/FAQs&tbl=FAQs_Registrant&id=2
     * (.PE) Peru https://www.nic.pe/nuevas_politicas_faq_2.php
     * (.PL) Poland http://www.dns.pl/IDN/allowed_character_sets.pdf
     * (.PR) Puerto Rico http://www.nic.pr/idn_rules.asp
     * (.PT) Portugal https://online.dns.pt/dns_2008/do?com=DS;8216320233;111;+PAGE(4000058)+K-CAT-CODIGO(C.125)+RCNT(100);
     * (.RU) Russia http://www.iana.org/domains/idn-tables/tables/ru_ru-ru_1.0.html
     * (.SA) Saudi Arabia http://www.iana.org/domains/idn-tables/tables/sa_ar_1.0.html
     * (.SE) Sweden http://www.iis.se/english/IDN_campaignsite.shtml?lang=en
     * (.SH) Saint Helena http://www.nic.sh/SH-IDN-Policy.pdf
     * (.SJ) Svalbard and Jan Mayen http://www.norid.no/domeneregistrering/idn/idn_nyetegn.en.html
     * (.TH) Thailand http://www.iana.org/domains/idn-tables/tables/th_th-th_1.0.html
     * (.TM) Turkmenistan http://www.nic.tm/TM-IDN-Policy.pdf
     * (.TR) Turkey https://www.nic.tr/index.php
     * (.UA) Ukraine http://www.iana.org/domains/idn-tables/tables/ua_cyrl_1.2.html
     * (.VE) Venice http://www.iana.org/domains/idn-tables/tables/ve_es_1.0.html
     * (.VN) Vietnam http://www.vnnic.vn/english/5-6-300-2-2-04-20071115.htm#1.%20Introduction
     *
     * @var array<string, string|array<int, string>>
     */
    protected $validIdns = [
        'AC'       => [1 => '/^[\x{002d}0-9a-zà-öø-ÿāăąćĉċčďđēėęěĝġģĥħīįĵķĺļľŀłńņňŋőœŕŗřśŝşšţťŧūŭůűųŵŷźżž]{1,63}$/iu'],
        'AR'       => [1 => '/^[\x{002d}0-9a-zà-ãç-êìíñ-õü]{1,63}$/iu'],
        'AS'       => [1 => '/^[\x{002d}0-9a-zà-öø-ÿāăąćĉċčďđēĕėęěĝğġģĥħĩīĭįıĵķĸĺļľłńņňŋōŏőœŕŗřśŝşšţťŧũūŭůűųŵŷźż]{1,63}$/iu'],
        'AT'       => [1 => '/^[\x{002d}0-9a-zà-öø-ÿœšž]{1,63}$/iu'],
        'BIZ'      => 'Hostname/Biz.php',
        'BR'       => [1 => '/^[\x{002d}0-9a-zà-ãçéíó-õúü]{1,63}$/iu'],
        'BV'       => [1 => '/^[\x{002d}0-9a-zàáä-éêñ-ôöøüčđńŋšŧž]{1,63}$/iu'],
        'CAT'      => [1 => '/^[\x{002d}0-9a-z·àç-éíïòóúü]{1,63}$/iu'],
        'CH'       => [1 => '/^[\x{002d}0-9a-zà-öø-ÿœ]{1,63}$/iu'],
        'CL'       => [1 => '/^[\x{002d}0-9a-záéíñóúü]{1,63}$/iu'],
        'CN'       => 'Hostname/Cn.php',
        'COM'      => 'Hostname/Com.php',
        'DE'       => [1 => '/^[\x{002d}0-9a-záàăâåäãąāæćĉčċçďđéèĕêěëėęēğĝġģĥħíìĭîïĩįīıĵķĺľļłńňñņŋóòŏôöőõøōœĸŕřŗśŝšşßťţŧúùŭûůüűũųūŵýŷÿźžżðþ]{1,63}$/iu'],
        'DK'       => [1 => '/^[\x{002d}0-9a-zäåæéöøü]{1,63}$/iu'],
        'EE'       => [1 => '/^[\x{002d}0-9a-zäõöüšž]{1,63}$/iu'],
        'ES'       => [1 => '/^[\x{002d}0-9a-zàáçèéíïñòóúü·]{1,63}$/iu'],
        'EU'       => [
            1 => '/^[\x{002d}0-9a-zà-öø-ÿ]{1,63}$/iu',
            2 => '/^[\x{002d}0-9a-zāăąćĉċčďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőœŕŗřśŝšťŧũūŭůűųŵŷźżž]{1,63}$/iu',
            3 => '/^[\x{002d}0-9a-zșț]{1,63}$/iu',
            4 => '/^[\x{002d}0-9a-zΐάέήίΰαβγδεζηθικλμνξοπρςστυφχψωϊϋόύώ]{1,63}$/iu',
            5 => '/^[\x{002d}0-9a-zабвгдежзийклмнопрстуфхцчшщъыьэюя]{1,63}$/iu',
            6 => '/^[\x{002d}0-9a-zἀ-ἇἐ-ἕἠ-ἧἰ-ἷὀ-ὅὐ-ὗὠ-ὧὰ-ὼώᾀ-ᾇᾐ-ᾗᾠ-ᾧᾰ-ᾴᾶᾷῂῃῄῆῇῐ-ῒΐῖῗῠ-ῧῲῳῴῶῷ]{1,63}$/iu',
        ],
        'FI'       => [1 => '/^[\x{002d}0-9a-zäåö]{1,63}$/iu'],
        'GR'       => [1 => '/^[\x{002d}0-9a-zΆΈΉΊΌΎ-ΡΣ-ώἀ-ἕἘ-Ἕἠ-ὅὈ-Ὅὐ-ὗὙὛὝὟ-ώᾀ-ᾴᾶ-ᾼῂῃῄῆ-ῌῐ-ΐῖ-Ίῠ-Ῥῲῳῴῶ-ῼ]{1,63}$/iu'],
        'HK'       => 'Hostname/Cn.php',
        'HR'       => [1 => '/^[\x{002d}0-9a-zžćčđš]{1,63}$/iu'],
        'HU'       => [1 => '/^[\x{002d}0-9a-záéíóöúüőű]{1,63}$/iu'],
        'IL'       => [
            1 => '/^[\x{002d}0-9\x{05D0}-\x{05EA}]{1,63}$/iu',
            2 => '/^[\x{002d}0-9a-z]{1,63}$/i',
        ],
        'INFO'     => [
            1 => '/^[\x{002d}0-9a-zäåæéöøü]{1,63}$/iu',
            2 => '/^[\x{002d}0-9a-záéíóöúüőű]{1,63}$/iu',
            3 => '/^[\x{002d}0-9a-záæéíðóöúýþ]{1,63}$/iu',
            4 => '/^[\x{AC00}-\x{D7A3}]{1,17}$/iu',
            5 => '/^[\x{002d}0-9a-zāčēģīķļņōŗšūž]{1,63}$/iu',
            6 => '/^[\x{002d}0-9a-ząčėęįšūųž]{1,63}$/iu',
            7 => '/^[\x{002d}0-9a-zóąćęłńśźż]{1,63}$/iu',
            8 => '/^[\x{002d}0-9a-záéíñóúü]{1,63}$/iu',
        ],
        'IO'       => [1 => '/^[\x{002d}0-9a-zà-öø-ÿăąāćĉčċďđĕěėęēğĝġģĥħĭĩįīıĵķĺľļłńňņŋŏőōœĸŕřŗśŝšşťţŧŭůűũųūŵŷźžż]{1,63}$/iu'],
        'IS'       => [1 => '/^[\x{002d}0-9a-záéýúíóþæöð]{1,63}$/iu'],
        'IT'       => [1 => '/^[\x{002d}0-9a-zàâäèéêëìîïòôöùûüæœçÿß-]{1,63}$/iu'],
        'JP'       => 'Hostname/Jp.php',
        'KR'       => [1 => '/^[\x{AC00}-\x{D7A3}]{1,17}$/iu'],
        'LI'       => [1 => '/^[\x{002d}0-9a-zà-öø-ÿœ]{1,63}$/iu'],
        'LT'       => [1 => '/^[\x{002d}0-9ąčęėįšųūž]{1,63}$/iu'],
        'MD'       => [1 => '/^[\x{002d}0-9ăâîşţ]{1,63}$/iu'],
        'MUSEUM'   => [1 => '/^[\x{002d}0-9a-zà-öø-ÿāăąćċčďđēėęěğġģħīįıķĺļľłńņňŋōőœŕŗřśşšţťŧūůűųŵŷźżžǎǐǒǔ\x{01E5}\x{01E7}\x{01E9}\x{01EF}ə\x{0292}ẁẃẅỳ]{1,63}$/iu'],
        'NET'      => 'Hostname/Com.php',
        'NO'       => [1 => '/^[\x{002d}0-9a-zàáä-éêñ-ôöøüčđńŋšŧž]{1,63}$/iu'],
        'NU'       => 'Hostname/Com.php',
        'ORG'      => [
            1 => '/^[\x{002d}0-9a-záéíñóúü]{1,63}$/iu',
            2 => '/^[\x{002d}0-9a-zóąćęłńśźż]{1,63}$/iu',
            3 => '/^[\x{002d}0-9a-záäåæéëíðóöøúüýþ]{1,63}$/iu',
            4 => '/^[\x{002d}0-9a-záéíóöúüőű]{1,63}$/iu',
            5 => '/^[\x{002d}0-9a-ząčėęįšūųž]{1,63}$/iu',
            6 => '/^[\x{AC00}-\x{D7A3}]{1,17}$/iu',
            7 => '/^[\x{002d}0-9a-zāčēģīķļņōŗšūž]{1,63}$/iu',
        ],
        'PE'       => [1 => '/^[\x{002d}0-9a-zñáéíóúü]{1,63}$/iu'],
        'PL'       => [
            1  => '/^[\x{002d}0-9a-zāčēģīķļņōŗšūž]{1,63}$/iu',
            2  => '/^[\x{002d}а-ик-ш\x{0450}ѓѕјљњќџ]{1,63}$/iu',
            3  => '/^[\x{002d}0-9a-zâîăşţ]{1,63}$/iu',
            4  => '/^[\x{002d}0-9а-яё\x{04C2}]{1,63}$/iu',
            5  => '/^[\x{002d}0-9a-zàáâèéêìíîòóôùúûċġħż]{1,63}$/iu',
            6  => '/^[\x{002d}0-9a-zàäåæéêòóôöøü]{1,63}$/iu',
            7  => '/^[\x{002d}0-9a-zóąćęłńśźż]{1,63}$/iu',
            8  => '/^[\x{002d}0-9a-zàáâãçéêíòóôõúü]{1,63}$/iu',
            9  => '/^[\x{002d}0-9a-zâîăşţ]{1,63}$/iu',
            10 => '/^[\x{002d}0-9a-záäéíóôúýčďĺľňŕšťž]{1,63}$/iu',
            11 => '/^[\x{002d}0-9a-zçë]{1,63}$/iu',
            12 => '/^[\x{002d}0-9а-ик-шђјљњћџ]{1,63}$/iu',
            13 => '/^[\x{002d}0-9a-zćčđšž]{1,63}$/iu',
            14 => '/^[\x{002d}0-9a-zâçöûüğış]{1,63}$/iu',
            15 => '/^[\x{002d}0-9a-záéíñóúü]{1,63}$/iu',
            16 => '/^[\x{002d}0-9a-zäõöüšž]{1,63}$/iu',
            17 => '/^[\x{002d}0-9a-zĉĝĥĵŝŭ]{1,63}$/iu',
            18 => '/^[\x{002d}0-9a-zâäéëîô]{1,63}$/iu',
            19 => '/^[\x{002d}0-9a-zàáâäåæçèéêëìíîïðñòôöøùúûüýćčłńřśš]{1,63}$/iu',
            20 => '/^[\x{002d}0-9a-zäåæõöøüšž]{1,63}$/iu',
            21 => '/^[\x{002d}0-9a-zàáçèéìíòóùú]{1,63}$/iu',
            22 => '/^[\x{002d}0-9a-zàáéíóöúüőű]{1,63}$/iu',
            23 => '/^[\x{002d}0-9ΐά-ώ]{1,63}$/iu',
            24 => '/^[\x{002d}0-9a-zàáâåæçèéêëðóôöøüþœ]{1,63}$/iu',
            25 => '/^[\x{002d}0-9a-záäéíóöúüýčďěňřšťůž]{1,63}$/iu',
            26 => '/^[\x{002d}0-9a-z·àçèéíïòóúü]{1,63}$/iu',
            27 => '/^[\x{002d}0-9а-ъьюя\x{0450}\x{045D}]{1,63}$/iu',
            28 => '/^[\x{002d}0-9а-яёіў]{1,63}$/iu',
            29 => '/^[\x{002d}0-9a-ząčėęįšūųž]{1,63}$/iu',
            30 => '/^[\x{002d}0-9a-záäåæéëíðóöøúüýþ]{1,63}$/iu',
            31 => '/^[\x{002d}0-9a-zàâæçèéêëîïñôùûüÿœ]{1,63}$/iu',
            32 => '/^[\x{002d}0-9а-щъыьэюяёєіїґ]{1,63}$/iu',
            33 => '/^[\x{002d}0-9א-ת]{1,63}$/iu',
        ],
        'PR'       => [1 => '/^[\x{002d}0-9a-záéíóúñäëïüöâêîôûàèùæçœãõ]{1,63}$/iu'],
        'PT'       => [1 => '/^[\x{002d}0-9a-záàâãçéêíóôõú]{1,63}$/iu'],
        'RS'       => [1 => '/^[\x{002d}0-9a-zßáâäçéëíîóôöúüýăąćčďđęěĺľłńňőŕřśşšţťůűźżž]{1,63}$/iu'],
        'RU'       => [1 => '/^[\x{002d}0-9а-яё]{1,63}$/iu'],
        'SA'       => [1 => '/^[\x{002d}.0-9\x{0621}-\x{063A}\x{0641}-\x{064A}\x{0660}-\x{0669}]{1,63}$/iu'],
        'SE'       => [1 => '/^[\x{002d}0-9a-zäåéöü]{1,63}$/iu'],
        'SH'       => [1 => '/^[\x{002d}0-9a-zà-öø-ÿăąāćĉčċďđĕěėęēğĝġģĥħĭĩįīıĵķĺľļłńňņŋŏőōœĸŕřŗśŝšşťţŧŭůűũųūŵŷźžż]{1,63}$/iu'],
        'SI'       => [
            1 => '/^[\x{002d}0-9a-zà-öø-ÿ]{1,63}$/iu',
            2 => '/^[\x{002d}0-9a-zāăąćĉċčďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőœŕŗřśŝšťŧũūŭůűųŵŷźżž]{1,63}$/iu',
            3 => '/^[\x{002d}0-9a-zșț]{1,63}$/iu',
        ],
        'SJ'       => [1 => '/^[\x{002d}0-9a-zàáä-éêñ-ôöøüčđńŋšŧž]{1,63}$/iu'],
        'SWISS'    => [1 => '/^[\x{002d}0-9a-zà-öø-ÿœ]{1,63}$/iu'],
        'TH'       => [1 => '/^[\x{002d}0-9a-z\x{0E01}-\x{0E3A}\x{0E40}-\x{0E4D}\x{0E50}-\x{0E59}]{1,63}$/iu'],
        'TM'       => [1 => '/^[\x{002d}0-9a-zà-öø-ÿāăąćĉċčďđēėęěĝġģĥħīįĵķĺļľŀłńņňŋőœŕŗřśŝşšţťŧūŭůűųŵŷźżž]{1,63}$/iu'],
        'TW'       => 'Hostname/Cn.php',
        'TR'       => [1 => '/^[\x{002d}0-9a-zğıüşöç]{1,63}$/iu'],
        'UA'       => [1 => '/^[\x{002d}0-9a-zабвгдежзийклмнопрстуфхцчшщъыьэюяѐёђѓєѕіїјљњћќѝўџґӂʼ]{1,63}$/iu'],
        'VE'       => [1 => '/^[\x{002d}0-9a-záéíóúüñ]{1,63}$/iu'],
        'VN'       => [1 => '/^[ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚÝàáâãèéêìíòóôõùúýĂăĐđĨĩŨũƠơƯư\x{1EA0}-\x{1EF9}]{1,63}$/iu'],
        'мон'      => [1 => '/^[\x{002d}0-9\x{0430}-\x{044F}]{1,63}$/iu'],
        'срб'      => [1 => '/^[\x{002d}0-9а-ик-шђјљњћџ]{1,63}$/iu'],
        'сайт'     => [1 => '/^[\x{002d}0-9а-яёіїѝйўґг]{1,63}$/iu'],
        'онлайн'   => [1 => '/^[\x{002d}0-9а-яёіїѝйўґг]{1,63}$/iu'],
        '中国'       => 'Hostname/Cn.php',
        '中國'       => 'Hostname/Cn.php',
        'ලංකා'     => [1 => '/^[\x{0d80}-\x{0dff}]{1,63}$/iu'],
        '香港'       => 'Hostname/Cn.php',
        '台湾'       => 'Hostname/Cn.php',
        '台灣'       => 'Hostname/Cn.php',
        'امارات'   => [1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu'],
        'الاردن'   => [1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu'],
        'السعودية' => [1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu'],
        'ไทย'      => [1 => '/^[\x{002d}0-9a-z\x{0E01}-\x{0E3A}\x{0E40}-\x{0E4D}\x{0E50}-\x{0E59}]{1,63}$/iu'],
        'рф'       => [1 => '/^[\x{002d}0-9а-яё]{1,63}$/iu'],
        'تونس'     => [1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu'],
        'مصر'      => [1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu'],
        'இலங்கை'   => [1 => '/^[\x{0b80}-\x{0bff}]{1,63}$/iu'],
        'فلسطين'   => [1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu'],
        'شبكة'     => [1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu'],
    ];

    /** @var array<string, array<int, int>> */
    protected $idnLength = [
        'BIZ'      => [5 => 17, 11 => 15, 12 => 20],
        'CN'       => [1 => 20],
        'COM'      => [3 => 17, 5 => 20],
        'HK'       => [1 => 15],
        'INFO'     => [4 => 17],
        'KR'       => [1 => 17],
        'NET'      => [3 => 17, 5 => 20],
        'ORG'      => [6 => 17],
        'TW'       => [1 => 20],
        'امارات'   => [1 => 30],
        'الاردن'   => [1 => 30],
        'السعودية' => [1 => 30],
        'تونس'     => [1 => 30],
        'مصر'      => [1 => 30],
        'فلسطين'   => [1 => 30],
        'شبكة'     => [1 => 30],
        '中国'       => [1 => 20],
        '中國'       => [1 => 20],
        '香港'       => [1 => 20],
        '台湾'       => [1 => 20],
        '台灣'       => [1 => 20],
    ];

    /** @var null|false|string */
    protected $tld;

    /**
     * Options for the hostname validator
     *
     * @var Options
     */
    protected $options = [
        'allow'       => self::ALLOW_DNS, // Allow these hostnames
        'useIdnCheck' => true, // Check IDN domains
        'useTldCheck' => true, // Check TLD elements
        'ipValidator' => null, // IP validator to use
    ];

    // phpcs:disable Squiz.Commenting.FunctionComment.ExtraParamComment

    /**
     * Sets validator options.
     *
     * @see http://www.iana.org/cctld/specifications-policies-cctlds-01apr02.htm  Technical Specifications for ccTLDs
     *
     * Options Parameters should be passed as an array in the following format:
     * $options = [
     *      'allow' => ALLOW_DNS, // OPTIONAL Set what types of hostname to allow (default ALLOW_DNS)
     *      'useIdnCheck' => true, // OPTIONAL Set whether IDN domains are validated (default true)
     *      'useTldCheck' => true, // Set whether the TLD element of a hostname is validated (default true)
     *      'ipValidator' => null, // An IP validator instance or null @link Ip
     * ];
     *
     * For backwards compatibility, options can also be passed as variables in the order stated above.
     *
     * @param Options $options OPTIONAL Array of validator options; see Hostname::$options
     */
    public function __construct($options = [])
    {
        if (! is_array($options)) {
            $options       = func_get_args();
            $temp['allow'] = array_shift($options);
            if (! empty($options)) {
                $temp['useIdnCheck'] = array_shift($options);
            }

            if (! empty($options)) {
                $temp['useTldCheck'] = array_shift($options);
            }

            if (! empty($options)) {
                $temp['ipValidator'] = array_shift($options);
            }

            $options = $temp;
        }

        if (! array_key_exists('ipValidator', $options)) {
            $options['ipValidator'] = null;
        }

        parent::__construct($options);
    }

    /**
     * Returns the set ip validator
     *
     * @deprecated Since 2.61.0 all options getters and setters will be removed in 3.0
     *
     * @return Ip
     */
    public function getIpValidator()
    {
        return $this->options['ipValidator'];
    }

    /**
     * @deprecated Since 2.61.0 all options getters and setters will be removed in 3.0
     *
     * @param Ip $ipValidator OPTIONAL
     * @return self
     */
    public function setIpValidator(?Ip $ipValidator = null)
    {
        if ($ipValidator === null) {
            $ipValidator = new Ip();
        }

        $this->options['ipValidator'] = $ipValidator;
        return $this;
    }

    /**
     * Returns the allow option
     *
     * @deprecated Since 2.61.0 all options getters and setters will be removed in 3.0
     *
     * @return int
     */
    public function getAllow()
    {
        return $this->options['allow'];
    }

    /**
     * Sets the allow option
     *
     * @deprecated Since 2.61.0 all options getters and setters will be removed in 3.0
     *
     * @param int $allow
     * @return $this Provides a fluent interface
     */
    public function setAllow($allow)
    {
        $this->options['allow'] = $allow;
        return $this;
    }

    /**
     * Returns the set idn option
     *
     * @deprecated Since 2.61.0 all options getters and setters will be removed in 3.0
     *
     * @return bool
     */
    public function getIdnCheck()
    {
        return $this->options['useIdnCheck'];
    }

    /**
     * Set whether IDN domains are validated
     *
     * This only applies when DNS hostnames are validated
     *
     * @deprecated Since 2.61.0 all options getters and setters will be removed in 3.0
     *
     * @param bool $useIdnCheck Set to true to validate IDN domains
     * @return $this
     */
    public function useIdnCheck($useIdnCheck)
    {
        $this->options['useIdnCheck'] = (bool) $useIdnCheck;
        return $this;
    }

    /**
     * Returns the set tld option
     *
     * @deprecated Since 2.61.0 all options getters and setters will be removed in 3.0
     *
     * @return bool
     */
    public function getTldCheck()
    {
        return $this->options['useTldCheck'];
    }

    /**
     * Set whether the TLD element of a hostname is validated
     *
     * This only applies when DNS hostnames are validated
     *
     * @deprecated Since 2.61.0 all options getters and setters will be removed in 3.0
     *
     * @param bool $useTldCheck Set to true to validate TLD elements
     * @return $this
     */
    public function useTldCheck($useTldCheck)
    {
        $this->options['useTldCheck'] = (bool) $useTldCheck;
        return $this;
    }

    /**
     * Defined by Interface
     *
     * Returns true if and only if the $value is a valid hostname with respect to the current allow option
     *
     * @param  string $value
     * @return bool
     */
    public function isValid($value)
    {
        if (! is_string($value)) {
            $this->error(self::INVALID);
            return false;
        }

        $this->setValue($value);
        // Check input against IP address schema
        if (
            ((preg_match('/^[0-9.]*$/', $value) && str_contains($value, '.'))
                || (preg_match('/^[0-9a-f:.]*$/i', $value) && str_contains($value, ':')))
            && $this->getIpValidator()->setTranslator($this->getTranslator())->isValid($value)
        ) {
            if (! ($this->getAllow() & self::ALLOW_IP)) {
                $this->error(self::IP_ADDRESS_NOT_ALLOWED);
                return false;
            }

            return true;
        }

        // Local hostnames are allowed to be partial (ending '.')
        if ($this->getAllow() & self::ALLOW_LOCAL) {
            if (str_ends_with($value, '.')) {
                $value = substr($value, 0, -1);
                if (str_ends_with($value, '.')) {
                    // Empty hostnames (ending '..') are not allowed
                    $this->error(self::INVALID_LOCAL_NAME);
                    return false;
                }
            }
        }

        $domainParts = explode('.', $value);

        // Prevent partial IP V4 addresses (ending '.')
        if (
            count($domainParts) === 4 && preg_match('/^[0-9.a-e:.]*$/i', $value)
            && $this->getIpValidator()->setTranslator($this->getTranslator())->isValid($value)
        ) {
            $this->error(self::INVALID_LOCAL_NAME);
        }

        $utf8StrWrapper = StringUtils::getWrapper('UTF-8');

        // Check input against DNS hostname schema
        if (
            count($domainParts) > 1
            && $utf8StrWrapper->strlen($value) >= 4
            && $utf8StrWrapper->strlen($value) <= 254
        ) {
            $status = false;

            do {
                // First check TLD
                $matches = [];
                if (
                    preg_match('/([^.]{2,63})$/u', end($domainParts), $matches)
                    || (array_key_exists(end($domainParts), $this->validIdns))
                ) {
                    reset($domainParts);

                    // Hostname characters are: *(label dot)(label dot label); max 254 chars
                    // label: id-prefix [*ldh{61} id-prefix]; max 63 chars
                    // id-prefix: alpha / digit
                    // ldh: alpha / digit / dash

                    $this->tld = $matches[1];
                    // Decode Punycode TLD to IDN
                    if (str_starts_with($this->tld, 'xn--')) {
                        $this->tld = $this->decodePunycode(substr($this->tld, 4));
                        if ($this->tld === false) {
                            return false;
                        }
                    } else {
                        $this->tld = strtoupper($this->tld);
                    }

                    // Match TLD against known list
                    $removedTld = false;
                    if ($this->getTldCheck()) {
                        if (
                            ! in_array(strtolower($this->tld), $this->validTlds)
                            && ! in_array($this->tld, $this->validTlds)
                        ) {
                            $this->error(self::UNKNOWN_TLD);
                            $status = false;
                            break;
                        }
                        // We have already validated that the TLD is fine. We don't want it to go through the below
                        // checks as new UTF-8 TLDs will incorrectly fail if there is no IDN regex for it.
                        array_pop($domainParts);
                        $removedTld = true;
                    }

                    /**
                     * Match against IDN hostnames
                     * Note: Keep label regex short to avoid issues with long patterns when matching IDN hostnames
                     *
                     * @see Hostname\Interface
                     */
                    $regexChars = [0 => '/^[a-z0-9\x2d]{1,63}$/i'];
                    if ($this->getIdnCheck() && isset($this->validIdns[$this->tld])) {
                        if (is_string($this->validIdns[$this->tld])) {
                            $regexChars += include __DIR__ . '/' . $this->validIdns[$this->tld];
                        } else {
                            $regexChars += $this->validIdns[$this->tld];
                        }
                    }

                    // Check each hostname part
                    $check          = 0;
                    $lastDomainPart = end($domainParts);
                    if (! $removedTld) {
                        $lastDomainPart = prev($domainParts);
                    }
                    foreach ($domainParts as $domainPart) {
                        // Decode Punycode domain names to IDN
                        if (str_starts_with($domainPart, 'xn--')) {
                            $domainPart = $this->decodePunycode(substr($domainPart, 4));
                            if ($domainPart === false) {
                                return false;
                            }
                        }

                        // Skip following checks if domain part is empty, as it definitely is not a valid hostname then
                        if ($domainPart === '') {
                            $this->error(self::INVALID_HOSTNAME);
                            $status = false;
                            break 2;
                        }

                        // Check dash (-) does not start, end or appear in 3rd and 4th positions
                        if (
                            $utf8StrWrapper->strpos($domainPart, '-') === 0
                            || ($utf8StrWrapper->strlen($domainPart) > 2
                                && $utf8StrWrapper->strpos($domainPart, '-', 2) === 2
                                && $utf8StrWrapper->strpos($domainPart, '-', 3) === 3
                            )
                            || $utf8StrWrapper->substr($domainPart, -1) === '-'
                        ) {
                            $this->error(self::INVALID_DASH);
                            $status = false;
                            break 2;
                        }

                        // Check each domain part
                        $checked        = false;
                        $isSubDomain    = $domainPart !== $lastDomainPart;
                        $partRegexChars = $isSubDomain ? ['/^[a-z0-9_\x2d]{1,63}$/i'] + $regexChars : $regexChars;
                        foreach ($partRegexChars as $regexKey => $regexChar) {
                            $status = preg_match($regexChar, $domainPart);
                            if ($status > 0) {
                                $length = 63;
                                if (
                                    array_key_exists($this->tld, $this->idnLength)
                                    && array_key_exists($regexKey, $this->idnLength[$this->tld])
                                ) {
                                    $length = $this->idnLength[$this->tld];
                                }

                                if ($utf8StrWrapper->strlen($domainPart) > $length) {
                                    $this->error(self::INVALID_HOSTNAME);
                                    $status = false;
                                } else {
                                    $checked = true;
                                    break;
                                }
                            }
                        }

                        if ($checked) {
                            ++$check;
                        }
                    }

                    // If one of the labels doesn't match, the hostname is invalid
                    if ($check !== count($domainParts)) {
                        $this->error(self::INVALID_HOSTNAME_SCHEMA);
                        $status = false;
                    }
                } else {
                    // Hostname not long enough
                    $this->error(self::UNDECIPHERABLE_TLD);
                    $status = false;
                }
            } while (false);

            // If the input passes as an Internet domain name, and domain names are allowed, then the hostname
            // passes validation
            if ($status && ($this->getAllow() & self::ALLOW_DNS)) {
                return true;
            }
        } elseif ($this->getAllow() & self::ALLOW_DNS) {
            $this->error(self::INVALID_HOSTNAME);
        }

        // Check for URI Syntax (RFC3986)
        if ($this->getAllow() & self::ALLOW_URI) {
            if (preg_match("/^([a-zA-Z0-9-._~!$&\'()*+,;=]|%[[:xdigit:]]{2}){1,254}$/i", $value)) {
                return true;
            }

            $this->error(self::INVALID_URI);
        }

        // Check input against local network name schema; last chance to pass validation
        $regexLocal = '/^(([a-zA-Z0-9\x2d]{1,63}\x2e)*[a-zA-Z0-9\x2d]{1,63}[\x2e]{0,1}){1,254}$/';
        $status     = preg_match($regexLocal, $value);

        // If the input passes as a local network name, and local network names are allowed, then the
        // hostname passes validation
        $allowLocal = $this->getAllow() & self::ALLOW_LOCAL;
        if ($status && $allowLocal) {
            return true;
        }

        // If the input does not pass as a local network name, add a message
        if (! $status) {
            $this->error(self::INVALID_LOCAL_NAME);
        }

        // If local network names are not allowed, add a message
        if ($status && ! $allowLocal) {
            $this->error(self::LOCAL_NAME_NOT_ALLOWED);
        }

        return false;
    }

    /**
     * Decodes a punycode encoded string to it's original utf8 string
     * Returns false in case of a decoding failure.
     *
     * @param  string $encoded Punycode encoded string to decode
     * @return string|false
     */
    protected function decodePunycode($encoded)
    {
        if (! preg_match('/^[a-z0-9-]+$/i', $encoded)) {
            // no punycode encoded string
            $this->error(self::CANNOT_DECODE_PUNYCODE);
            return false;
        }

        $decoded   = [];
        $separator = strrpos($encoded, '-');
        if ($separator > 0) {
            for ($x = 0; $x < $separator; ++$x) {
                // prepare decoding matrix
                $decoded[] = ord($encoded[$x]);
            }
        }

        $lengthd = count($decoded);
        $lengthe = strlen($encoded);

        // decoding
        $init  = true;
        $base  = 72;
        $index = 0;
        $char  = 0x80;

        for ($indexe = $separator !== false ? $separator + 1 : 0; $indexe < $lengthe; ++$lengthd) {
            for ($oldIndex = $index, $pos = 1, $key = 36; 1; $key += 36) {
                if (! isset($encoded[$indexe])) {
                    break 2;
                }

                $hex   = ord($encoded[$indexe++]);
                $digit = $hex - 48 < 10 ? $hex - 22
                       : ($hex - 65 < 26 ? $hex - 65
                       : ($hex - 97 < 26 ? $hex - 97
                       : 36));

                $index += $digit * $pos;
                $tag    = $key <= $base ? 1 : ($key >= $base + 26 ? 26 : $key - $base);
                if ($digit < $tag) {
                    break;
                }

                $pos = (int) ($pos * (36 - $tag));
            }

            $delta  = intval($init ? ($index - $oldIndex) / 700 : ($index - $oldIndex) / 2);
            $delta += intval($delta / ($lengthd + 1));
            for ($key = 0; $delta > 910 / 2; $key += 36) {
                $delta = intval($delta / 35);
            }

            $base   = intval($key + 36 * $delta / ($delta + 38));
            $init   = false;
            $char  += (int) ($index / ($lengthd + 1));
            $index %= $lengthd + 1;
            if ($lengthd > 0) {
                for ($i = $lengthd; $i > $index; $i--) {
                    $decoded[$i] = $decoded[$i - 1];
                }
            }

            $decoded[$index++] = $char;
        }

        // convert decoded ucs4 to utf8 string
        foreach ($decoded as $key => $value) {
            if ($value < 128) {
                $decoded[$key] = chr($value);
            } elseif ($value < 1 << 11) {
                $decoded[$key]  = chr(192 + ($value >> 6));
                $decoded[$key] .= chr(128 + ($value & 63));
            } elseif ($value < 1 << 16) {
                $decoded[$key]  = chr(224 + ($value >> 12));
                $decoded[$key] .= chr(128 + (($value >> 6) & 63));
                $decoded[$key] .= chr(128 + ($value & 63));
            } elseif ($value < 1 << 21) {
                $decoded[$key]  = chr(240 + ($value >> 18));
                $decoded[$key] .= chr(128 + (($value >> 12) & 63));
                $decoded[$key] .= chr(128 + (($value >> 6) & 63));
                $decoded[$key] .= chr(128 + ($value & 63));
            } else {
                $this->error(self::CANNOT_DECODE_PUNYCODE);
                return false;
            }
        }

        return implode($decoded);
    }
}
