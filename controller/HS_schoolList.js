const AreaArr = [
	{
		conference :'北區',
		value : 'N',
		confmembers : [
			{city:'臺北市',value:'A'},
			{city:'新北市',value:'B'},
			{city:'基隆市',value:'C'},
			{city:'桃園市',value:'D'},
			{city:'新竹市',value:'E'},
			{city:'新竹縣',value:'F'},
			{city:'宜蘭縣',value:'P'}
		]
	},
	{
		conference :'中區',
		value : 'M',
		confmembers : [
			{city:'苗栗縣',value:'G'},
			{city:'臺中市',value:'H'},
			{city:'彰化縣',value:'I'},
			{city:'雲林縣',value:'J'},
			{city:'南投縣',value:'S'},
			{city:'花蓮縣',value:'Q'}
		]
	},
	{
		conference :'南區',
		value : 'S',
		confmembers : [
			{city:'嘉義市',value:'K'},
			{city:'嘉義縣',value:'L'},
			{city:'臺南市',value:'M'},
			{city:'高雄市',value:'N'},
			{city:'屏東縣',value:'O'},
			{city:'臺東縣',value:'R'},
			{city:'澎湖縣',value:'T'},
			{city:'金門縣',value:'U'},
			{city:'連江縣',value:'V'}
		]
	}
]

const histockArr = [
	
{
        city: '臺北市',
		value:'A',
        hischool: [
			{value:'001', hischool:'私立育達家商'},
			{value:'002', hischool:'市立西松高中'},
			{value:'003', hischool:'市立中崙高中'},
			{value:'004', hischool:'臺北市私立協和祐德高級中學'},
			{value:'005', hischool:'市立松山高中'},
			{value:'006', hischool:'市立永春高中'},
			{value:'007', hischool:'市立松山家商'},
			{value:'008', hischool:'市立松山工農'},
			{value:'009', hischool:'國立師大附中'},
			{value:'010', hischool:'私立延平中學'},
			{value:'011', hischool:'私立金甌女中'},
			{value:'012', hischool:'私立復興實驗高中'},
			{value:'013', hischool:'私立東方工商'},
			{value:'014', hischool:'私立喬治工商'},
			{value:'015', hischool:'私立開平餐飲'},
			{value:'016', hischool:'市立和平高中'},
			{value:'017', hischool:'市立大安高工'},
			{value:'018', hischool:'私立大同高中'},
			{value:'019', hischool:'私立稻江護家'},
			{value:'020', hischool:'市立中山女中'},
			{value:'021', hischool:'市立大同高中'},
			{value:'022', hischool:'市立大直高中'},
			{value:'023', hischool:'私立強恕中學'},
			{value:'024', hischool:'私立開南商工'},
			{value:'025', hischool:'市立建國中學'},
			{value:'026', hischool:'市立成功中學'},
			{value:'027', hischool:'市立北一女中'},
			{value:'028', hischool:'私立稻江高商'},
			{value:'029', hischool:'市立明倫高中'},
			{value:'030', hischool:'市立成淵高中'},
			{value:'031', hischool:'市立華江高中'},
			{value:'032', hischool:'市立大理高中'},
			{value:'033', hischool:'國立政大附中'},
			{value:'034', hischool:'私立東山高中'},
			{value:'035', hischool:'私立滬江高中'},
			{value:'036', hischool:'私立大誠高中'},
			{value:'037', hischool:'私立再興中學'},
			{value:'038', hischool:'私立景文高中'},
			{value:'039', hischool:'臺北市靜心高中'},
			{value:'040', hischool:'市立景美女中'},
			{value:'041', hischool:'市立萬芳高中'},
			{value:'042', hischool:'市立木柵高工'},
			{value:'043', hischool:'市立南港高中'},
			{value:'044', hischool:'市立育成高中'},
			{value:'045', hischool:'市立南港高工'},
			{value:'046', hischool:'私立文德女中'},
			{value:'047', hischool:'私立方濟中學'},
			{value:'048', hischool:'私立達人女中'},
			{value:'049', hischool:'市立內湖高中'},
			{value:'050', hischool:'市立麗山高中'},
			{value:'051', hischool:'市立南湖高中'},
			{value:'052', hischool:'市立內湖高工'},
			{value:'053', hischool:'私立泰北高中'},
			{value:'054', hischool:'私立衛理女中'},
			{value:'055', hischool:'私立華興中學'},
			{value:'056', hischool:'私立華岡藝校'},
			{value:'057', hischool:'市立陽明高中'},
			{value:'058', hischool:'市立百齡高中'},
			{value:'059', hischool:'市立士林高商'},
			{value:'060', hischool:'私立薇閣高中'},
			{value:'061', hischool:'臺北市私立奎山實驗高級中學'},
			{value:'062', hischool:'私立惇敘工商'},
			{value:'063', hischool:'市立復興高中'},
			{value:'064', hischool:'市立中正高中'},
			{value:'065', hischool:'私立南華高中進修學校'},
			{value:'066', hischool:'私立志仁中學進修學校'}
        ]
    },


    {
        city: '新北市',
		value:'B',
        hischool: [
			{value:'001', hischool:'國立華僑高級中等學校'},
			{value:'002', hischool:'私立淡江高中'},
			{value:'003', hischool:'私立康橋高中'},
			{value:'004', hischool:'私立金陵女中'},
			{value:'005', hischool:'新北市裕德高級中等學校'},
			{value:'006', hischool:'財團法人南山高中'},
			{value:'007', hischool:'財團法人恆毅高中'},
			{value:'008', hischool:'私立聖心女中'},
			{value:'009', hischool:'私立崇義高中'},
			{value:'010', hischool:'財團法人中華高中'},
			{value:'011', hischool:'私立東海高中'},
			{value:'012', hischool:'私立格致高中'},
			{value:'013', hischool:'私立醒吾高中'},
			{value:'014', hischool:'私立徐匯高中'},
			{value:'015', hischool:'財團法人崇光女中'},
			{value:'016', hischool:'私立光仁高中'},
			{value:'017', hischool:'私立竹林高中'},
			{value:'018', hischool:'私立及人高中'},
			{value:'019', hischool:'財團法人辭修高中'},
			{value:'020', hischool:'新北市林口康橋國際高中'},
			{value:'021', hischool:'私立時雨高中'},
			{value:'022', hischool:'私立樹人家商'},
			{value:'023', hischool:'私立復興商工'},
			{value:'024', hischool:'私立南強工商'},
			{value:'025', hischool:'私立穀保家商'},
			{value:'026', hischool:'私立開明工商'},
			{value:'027', hischool:'私立智光商工'},
			{value:'028', hischool:'私立清傳高商'},
			{value:'029', hischool:'私立能仁家商'},
			{value:'030', hischool:'私立豫章工商'},
			{value:'031', hischool:'私立莊敬工家'},
			{value:'032', hischool:'私立莊敬工家'},
			{value:'033', hischool:'私立中華商海'},
			{value:'034', hischool:'市立泰山高中'},
			{value:'035', hischool:'市立板橋高中'},
			{value:'036', hischool:'市立新店高中'},
			{value:'037', hischool:'市立中和高中'},
			{value:'038', hischool:'市立新莊高中'},
			{value:'039', hischool:'市立新北高中'},
			{value:'040', hischool:'市立林口高中'},
			{value:'041', hischool:'市立瑞芳高工'},
			{value:'042', hischool:'市立三重商工'},
			{value:'043', hischool:'市立新北高工'},
			{value:'044', hischool:'市立淡水商工'},
			{value:'045', hischool:'市立海山高中'},
			{value:'046', hischool:'市立三重高中'},
			{value:'047', hischool:'市立永平高中'},
			{value:'048', hischool:'市立樹林高中'},
			{value:'049', hischool:'市立明德高中'},
			{value:'050', hischool:'市立秀峰高中'},
			{value:'051', hischool:'市立金山高中'},
			{value:'052', hischool:'市立安康高中'},
			{value:'053', hischool:'市立雙溪高中'},
			{value:'054', hischool:'市立石碇高中'},
			{value:'055', hischool:'市立丹鳳高中'},
			{value:'056', hischool:'市立清水高中'},
			{value:'057', hischool:'市立三民高中'},
			{value:'058', hischool:'市立錦和高中'},
			{value:'059', hischool:'市立光復高中'},
			{value:'060', hischool:'市立竹圍高中'},
			{value:'061', hischool:'市立北大高級中學'},
			{value:'062', hischool:'市立豐珠中學'},
			{value:'063', hischool:'市立鶯歌工商'},
			{value:'064', hischool:'市立樟樹國際實中'},
			{value:'065', hischool:'私立光華高商進修學校'},
        ]
    },


	{
        city: '基隆市',
		value:'C',
        hischool: [
			{value:'001', hischool:'國立基隆女中'},
			{value:'002', hischool:'國立基隆高中'},
			{value:'003', hischool:'國立基隆海事'},
			{value:'004', hischool:'國立基隆商工'},
			{value:'005', hischool:'私立二信高中'},
			{value:'006', hischool:'輔大聖心高中'},
			{value:'007', hischool:'私立光隆家商'},
			{value:'008', hischool:'私立培德工家'},
			{value:'009', hischool:'市立中山高中'},
			{value:'010', hischool:'市立安樂高中'},
			{value:'011', hischool:'市立暖暖高中'},
			{value:'012', hischool:'市立八斗高中'}
        ]
    },
	
	
    {
        city: '桃園市',
		value:'D',
        hischool: [
			{value:'001', hischool:'國立中央大學附屬中壢高中'},
			{value:'002', hischool:'國立北科大附屬桃園農工'},
			{value:'003', hischool:'私立漢英高中'},
			{value:'004', hischool:'桃園市育達高中'},
			{value:'005', hischool:'私立六和高中'},
			{value:'006', hischool:'桃園市復旦高中'},
			{value:'007', hischool:'桃園市治平高中'},
			{value:'008', hischool:'桃園市振聲高中'},
			{value:'009', hischool:'私立光啟高中'},
			{value:'010', hischool:'桃園市啟英高中'},
			{value:'011', hischool:'桃園市清華高中'},
			{value:'012', hischool:'桃園市新興高中'},
			{value:'013', hischool:'私立至善高中'},
			{value:'014', hischool:'桃園市大興高中'},
			{value:'015', hischool:'私立大華高中'},
			{value:'016', hischool:'私立成功工商'},
			{value:'017', hischool:'私立方曙商工'},
			{value:'018', hischool:'私立永平工商'},
			{value:'019', hischool:'市立龍潭高中'},
			{value:'020', hischool:'市立桃園高中'},
			{value:'021', hischool:'市立武陵高中'},
			{value:'022', hischool:'市立楊梅高中'},
			{value:'023', hischool:'市立陽明高中'},
			{value:'024', hischool:'市立內壢高中'},
			{value:'025', hischool:'市立中壢高商'},
			{value:'026', hischool:'市立中壢家商'},
			{value:'027', hischool:'市立南崁高中'},
			{value:'028', hischool:'市立大溪高中'},
			{value:'029', hischool:'市立壽山高中'},
			{value:'030', hischool:'市立平鎮高中'},
			{value:'031', hischool:'市立觀音高中'},
			{value:'032', hischool:'市立新屋高級中等學校'},
			{value:'033', hischool:'市立永豐高中'},
			{value:'034', hischool:'市立大園國際高中'}
        ]
    },
	

	{
        city: '新竹市',
		value:'E',
        hischool: [
			{value:'001', hischool:'國立科學工業園區實驗高中'},
			{value:'002', hischool:'國立新竹女中'},
			{value:'003', hischool:'國立新竹高中'},
			{value:'004', hischool:'國立新竹高商'},
			{value:'005', hischool:'國立新竹高工'},
			{value:'006', hischool:'私立光復高中'},
			{value:'007', hischool:'私立曙光女中'},
			{value:'008', hischool:'私立磐石高中'},
			{value:'009', hischool:'私立世界高中'},
			{value:'010', hischool:'市立成德高中'},
			{value:'011', hischool:'市立香山高中'},
			{value:'012', hischool:'市立建功高中'}
        ]
    },


    {
        city: '新竹縣',
		value:'F',
        hischool: [
			{valueL:'001', hischool:'國立竹東高中'},
			{valueL:'002', hischool:'國立關西高中'},
			{valueL:'003', hischool:'國立竹北高中'},
			{valueL:'004', hischool:'私立義民高中'},
			{valueL:'005', hischool:'私立忠信高中'},
			{valueL:'006', hischool:'私立東泰高中'},
			{valueL:'007', hischool:'私立仰德高中'},
			{valueL:'008', hischool:'私立內思高工'},
			{valueL:'009', hischool:'縣立六家高級中學'},
			{valueL:'010', hischool:'縣立湖口高中'},
			{valueL:'011', hischool:'誠正中學'}
		]
    },

	
    {
        city: '苗栗縣',
		value:'G',
        hischool: [
			{value:'001', hischool:'國立苗栗高中'},
			{value:'002', hischool:'國立竹南高中'},
			{value:'003', hischool:'國立卓蘭高中'},
			{value:'004', hischool:'國立苑裡高中'},
			{value:'005', hischool:'國立大湖農工'},
			{value:'006', hischool:'國立苗栗農工'},
			{value:'007', hischool:'國立苗栗高商'},
			{value:'008', hischool:'私立君毅高中'},
			{value:'009', hischool:'私立大成高中'},
			{value:'010', hischool:'私立建臺高中'},
			{value:'011', hischool:'私立全人實驗高中'},
			{value:'012', hischool:'私立中興商工'},
			{value:'013', hischool:'私立育民工家'},
			{value:'014', hischool:'私立賢德工商'},
			{value:'015', hischool:'私立龍德家商'},
			{value:'016', hischool:'縣立三義高中'},
			{value:'017', hischool:'縣立苑裡高中'},
			{value:'018', hischool:'縣立興華高中'},
			{value:'019', hischool:'縣立大同高中'}
        ]
    },
	
	
    {
        city: '臺中市',
		value:'H',
        hischool: [
			{value:'001', hischool:'國立興大附中'},
			{value:'002', hischool:'國立中科實驗高級中學'},
			{value:'003', hischool:'財團法人常春藤高中'},
			{value:'004', hischool:'私立明台高中'},
			{value:'005', hischool:'私立致用高中'},
			{value:'006', hischool:'私立大明高中'},
			{value:'007', hischool:'私立嘉陽高中'},
			{value:'008', hischool:'私立明道高中'},
			{value:'009', hischool:'私立僑泰高中'},
			{value:'010', hischool:'私立華盛頓高中'},
			{value:'011', hischool:'私立青年高中'},
			{value:'012', hischool:'私立弘文高中'},
			{value:'013', hischool:'私立立人高中'},
			{value:'014', hischool:'私立玉山高中'},
			{value:'015', hischool:'私立慈明高中'},
			{value:'016', hischool:'華德福大地實驗學校'},
			{value:'017', hischool:'市立大甲高中'},
			{value:'018', hischool:'市立清水高中'},
			{value:'019', hischool:'市立豐原高中'},
			{value:'020', hischool:'市立豐原高商'},
			{value:'021', hischool:'市立大甲高工'},
			{value:'022', hischool:'市立東勢高工'},
			{value:'023', hischool:'市立沙鹿高工'},
			{value:'024', hischool:'市立霧峰農工'},
			{value:'025', hischool:'市立后綜高中'},
			{value:'026', hischool:'市立大里高中'},
			{value:'027', hischool:'市立新社高中'},
			{value:'028', hischool:'市立長億高中'},
			{value:'029', hischool:'市立中港高中'},
			{value:'030', hischool:'市立龍津高中'},
			{value:'031', hischool:'國立興大附農'},
			{value:'032', hischool:'私立東大附中'},
			{value:'033', hischool:'私立葳格高中'},
			{value:'034', hischool:'私立新民高中'},
			{value:'035', hischool:'私立宜寧高中'},
			{value:'036', hischool:'私立明德高中'},
			{value:'037', hischool:'私立衛道高中'},
			{value:'038', hischool:'私立曉明女中'},
			{value:'039', hischool:'私立嶺東高中'},
			{value:'040', hischool:'私立磊川華德福實驗教育學校'},
			{value:'041', hischool:'財團法人光華高工'},
			{value:'042', hischool:'市立臺中女中'},
			{value:'043', hischool:'市立臺中一中'},
			{value:'044', hischool:'市立忠明高中'},
			{value:'045', hischool:'市立西苑高中'},
			{value:'046', hischool:'市立東山高中'},
			{value:'047', hischool:'市立惠文高中'},
			{value:'048', hischool:'市立臺中家商'},
			{value:'049', hischool:'市立臺中高工'},
			{value:'050', hischool:'市立臺中二中'},
			{value:'051', hischool:'市立文華高中'}
        ]
    },

	
    {
        city: '彰化縣',
		value:'I',
        hischool: [
			{value:'001', hischool:'國立彰化女中'},
			{value:'002', hischool:'國立員林高中'},
			{value:'003', hischool:'國立彰化高中'},
			{value:'004', hischool:'國立鹿港高中'},
			{value:'005', hischool:'國立溪湖高中'},
			{value:'006', hischool:'國立彰師附工'},
			{value:'007', hischool:'國立永靖高工'},
			{value:'008', hischool:'國立二林工商'},
			{value:'009', hischool:'國立秀水高工'},
			{value:'010', hischool:'國立彰化高商'},
			{value:'011', hischool:'國立員林農工'},
			{value:'012', hischool:'國立員林崇實高工'},
			{value:'013', hischool:'國立員林家商'},
			{value:'014', hischool:'國立北斗家商'},
			{value:'015', hischool:'私立精誠高中'},
			{value:'016', hischool:'私立文興高中'},
			{value:'017', hischool:'財團法人正德高中'},
			{value:'018', hischool:'私立大慶商工'},
			{value:'019', hischool:'私立達德商工'},
			{value:'020', hischool:'縣立彰化藝術高中'},
			{value:'021', hischool:'縣立二林高中'},
			{value:'022', hischool:'縣立和美高中'},
			{value:'023', hischool:'縣立田中高中'},
			{value:'024', hischool:'縣立成功高中'}
        ]
    },

	
    {
        city: '雲林縣',
		value:'J',
        hischool: [
			{value:'001', hischool:'國立斗六高中'},
			{value:'002', hischool:'國立北港高中'},
			{value:'003', hischool:'國立虎尾高中'},
			{value:'004', hischool:'國立虎尾農工'},
			{value:'005', hischool:'國立西螺農工'},
			{value:'006', hischool:'國立斗六家商'},
			{value:'007', hischool:'國立北港農工'},
			{value:'008', hischool:'國立土庫商工'},
			{value:'009', hischool:'私立永年高中'},
			{value:'010', hischool:'私立正心高中'},
			{value:'011', hischool:'私立文生高中'},
			{value:'012', hischool:'私立巨人高中'},
			{value:'013', hischool:'私立揚子高中'},
			{value:'014', hischool:'財團法人義峰高中'},
			{value:'015', hischool:'福智高中'},
			{value:'016', hischool:'雲林縣維多利亞實驗高中'},
			{value:'017', hischool:'私立大成商工'},
			{value:'018', hischool:'私立大德工商'},
			{value:'019', hischool:'縣立斗南高中'},
			{value:'020', hischool:'縣立麥寮高中'},
			{value:'021', hischool:'縣立古坑華德福實驗高級中學'},
			{value:'022', hischool:'縣立蔦松藝術高中'}
        ]
    },

	
	{
        city: '嘉義市',
		value:'K',
        hischool: [
			{value:'001', hischool:'國立嘉義女中'},
			{value:'002', hischool:'國立嘉義高中'},
			{value:'003', hischool:'國立華南高商'},
			{value:'004', hischool:'國立嘉義高工'},
			{value:'005', hischool:'國立嘉義高商'},
			{value:'006', hischool:'國立嘉義家職'},
			{value:'007', hischool:'私立興華高中'},
			{value:'008', hischool:'私立仁義高中'},
			{value:'009', hischool:'私立嘉華高中'},
			{value:'010', hischool:'私立輔仁高中'},
			{value:'011', hischool:'私立宏仁女中'},
			{value:'012', hischool:'私立立仁高中'},
			{value:'013', hischool:'私立東吳工家'}
        ]
    },
	

    {
        city: '嘉義縣',
		value:'L',
        hischool: [
			{value:'001', hischool:'國立東石高中'},
			{value:'002', hischool:'國立新港藝術高中'},
			{value:'003', hischool:'國立民雄農工'},
			{value:'004', hischool:'私立同濟高中'},
			{value:'005', hischool:'私立協同高中'},
			{value:'006', hischool:'私立協志工商'},
			{value:'007', hischool:'私立萬能工商'},
			{value:'008', hischool:'私立弘德工商'},
			{value:'009', hischool:'縣立竹崎高中'},
			{value:'010', hischool:'縣立永慶高中'}
        ]
    },
	
	
    {
        city: '臺南市',
		value:'M',
        hischool: [
			{value:'001', hischool:'國立新豐高中'},
			{value:'002', hischool:'國立臺南大學附中'},
			{value:'003', hischool:'國立北門高中'},
			{value:'004', hischool:'國立新營高中'},
			{value:'005', hischool:'國立後壁高中'},
			{value:'006', hischool:'國立善化高中'},
			{value:'007', hischool:'國立新化高中'},
			{value:'008', hischool:'國立南科國際實驗高中'},
			{value:'009', hischool:'國立新化高工'},
			{value:'010', hischool:'國立白河商工'},
			{value:'011', hischool:'國立北門農工'},
			{value:'012', hischool:'國立曾文家商'},
			{value:'013', hischool:'國立新營高工'},
			{value:'014', hischool:'國立玉井工商'},
			{value:'015', hischool:'國立臺南高工'},
			{value:'016', hischool:'國立曾文農工'},
			{value:'017', hischool:'私立南光高中'},
			{value:'018', hischool:'私立鳳和高中'},
			{value:'019', hischool:'私立港明高中'},
			{value:'020', hischool:'臺南市興國高中'},
			{value:'021', hischool:'私立明達高中'},
			{value:'022', hischool:'私立黎明高中'},
			{value:'023', hischool:'私立新榮高中'},
			{value:'024', hischool:'私立陽明工商'},
			{value:'025', hischool:'私立育德工家'},
			{value:'026', hischool:'市立大灣高中'},
			{value:'027', hischool:'市立永仁高中'},
			{value:'028', hischool:'國立臺南二中'},
			{value:'029', hischool:'國立臺南一中'},
			{value:'030', hischool:'國立臺南女中'},
			{value:'031', hischool:'國立家齊高中'},
			{value:'032', hischool:'國立臺南高商'},
			{value:'033', hischool:'國立臺南海事'},
			{value:'034', hischool:'私立長榮高中'},
			{value:'035', hischool:'私立長榮女中'},
			{value:'036', hischool:'財團法人聖功女中'},
			{value:'037', hischool:'臺南市光華高中'},
			{value:'038', hischool:'私立六信高中'},
			{value:'039', hischool:'私立瀛海高中'},
			{value:'040', hischool:'私立崑山高中'},
			{value:'041', hischool:'私立德光高中'},
			{value:'042', hischool:'財團法人慈濟高中'},
			{value:'043', hischool:'私立南英商工'},
			{value:'044', hischool:'私立亞洲餐旅'},
			{value:'045', hischool:'私立慈幼工商'},
			{value:'046', hischool:'市立南寧高中'},
			{value:'047', hischool:'市立土城高中'}
		]
    },

	
    {
        city: '高雄市',
		value:'N',
        hischool: [
			{value:'001', hischool:'國立鳳山高中'},
			{value:'002', hischool:'國立岡山高中'},
			{value:'003', hischool:'國立旗美高中'},
			{value:'004', hischool:'國立鳳新高中'},
			{value:'005', hischool:'國立旗山農工'},
			{value:'006', hischool:'國立岡山農工'},
			{value:'007', hischool:'國立鳳山商工'},
			{value:'008', hischool:'財團法人新光高中'},
			{value:'009', hischool:'財團法人普門中學'},
			{value:'010', hischool:'私立正義高中'},
			{value:'011', hischool:'私立義大國際高中'},
			{value:'012', hischool:'私立中山工商'},
			{value:'013', hischool:'私立旗美商工'},
			{value:'014', hischool:'私立高英工商'},
			{value:'015', hischool:'私立華德工家'},
			{value:'016', hischool:'私立高苑工商'},
			{value:'017', hischool:'市立文山高中'},
			{value:'018', hischool:'市立林園高中'},
			{value:'019', hischool:'市立仁武高中'},
			{value:'020', hischool:'市立路竹高中'},
			{value:'021', hischool:'市立六龜高中'},
			{value:'022', hischool:'市立福誠高中'},
			{value:'023', hischool:'私立明誠高中'},
			{value:'024', hischool:'私立大榮高中'},
			{value:'025', hischool:'私立中華藝校'},
			{value:'026', hischool:'市立鼓山高中'},
			{value:'027', hischool:'市立左營高中'},
			{value:'028', hischool:'市立新莊高中'},
			{value:'029', hischool:'市立海青工商'},
			{value:'030', hischool:'市立三民家商'},
			{value:'031', hischool:'國立中山大學附屬國光高中'},
			{value:'032', hischool:'市立中山高中'},
			{value:'033', hischool:'市立楠梓高中'},
			{value:'034', hischool:'私立立志高中'},
			{value:'035', hischool:'南海月光實驗學校'},
			{value:'036', hischool:'私立樹德家商'},
			{value:'037', hischool:'市立高雄中學'},
			{value:'038', hischool:'市立三民高中'},
			{value:'039', hischool:'市立高雄高工'},
			{value:'040', hischool:'市立新興高中'},
			{value:'041', hischool:'市立高雄高商'},
			{value:'042', hischool:'市立高雄女中'},
			{value:'043', hischool:'國立高師大附中'},
			{value:'044', hischool:'私立復華高中'},
			{value:'045', hischool:'天主教道明中學'},
			{value:'046', hischool:'私立國際商工'},
			{value:'047', hischool:'市立中正高中'},
			{value:'048', hischool:'市立前鎮高中'},
			{value:'049', hischool:'市立瑞祥高中'},
			{value:'050', hischool:'市立中正高工'},
			{value:'051', hischool:'國立高餐大附屬餐旅中學'},
			{value:'052', hischool:'私立高鳳工家'},
			{value:'053', hischool:'市立小港高中'}
		]
    },

	
	{
        city: '屏東縣',
		value:'O',
        hischool: [
			{value:'001', hischool:'國立屏東女中'},
			{value:'002', hischool:'國立屏東高中'},
			{value:'003', hischool:'國立潮州高中'},
			{value:'004', hischool:'國立屏北高中'},
			{value:'005', hischool:'國立內埔農工'},
			{value:'006', hischool:'國立屏東高工'},
			{value:'007', hischool:'國立佳冬高農'},
			{value:'008', hischool:'國立東港海事'},
			{value:'009', hischool:'國立恆春工商'},
			{value:'010', hischool:'財團法人屏榮高中'},
			{value:'011', hischool:'私立陸興高中'},
			{value:'012', hischool:'私立美和高中'},
			{value:'013', hischool:'私立民生家商'},
			{value:'014', hischool:'私立華洲工家'},
			{value:'015', hischool:'私立日新工商'},
			{value:'016', hischool:'縣立大同高中'},
			{value:'017', hischool:'縣立枋寮高中'},
			{value:'018', hischool:'縣立東港高中'},
			{value:'019', hischool:'縣立來義高中'}
        ]
    },

	
    {
        city: '宜蘭縣',
		value:'P',
        hischool: [
			{value:'001', hischool:'國立蘭陽女中'},
			{value:'002', hischool:'國立宜蘭高中'},
			{value:'003', hischool:'國立羅東高中'},
			{value:'004', hischool:'國立宜蘭高商'},
			{value:'005', hischool:'國立羅東高商'},
			{value:'006', hischool:'國立蘇澳海事'},
			{value:'007', hischool:'國立羅東高工'},
			{value:'008', hischool:'國立頭城家商'},
			{value:'009', hischool:'私立慧燈高中'},
			{value:'010', hischool:'私立中道高中'},
			{value:'011', hischool:'縣立南澳高中'},
			{value:'012', hischool:'縣立慈心華德福實中'}
        ]
    },

	
	{
        city: '花蓮縣',
		value:'Q',
        hischool: [
			{value:'001', hischool:'國立花蓮女中'},
			{value:'002', hischool:'國立花蓮高中'},
			{value:'003', hischool:'國立玉里高中'},
			{value:'004', hischool:'國立花蓮高農'},
			{value:'005', hischool:'國立花蓮高工'},
			{value:'006', hischool:'國立花蓮高商'},
			{value:'007', hischool:'國立光復商工'},
			{value:'008', hischool:'私立海星高中'},
			{value:'009', hischool:'私立四維高中'},
			{value:'010', hischool:'財團法人慈濟大學附中'},
			{value:'011', hischool:'花蓮縣上騰工商'},
			{value:'012', hischool:'花蓮縣立體育高中'},
			{value:'013', hischool:'縣立南平中學'}
        ]
    },

	
	{
        city: '臺東縣',
		value:'R',
        hischool: [
			{value:'001', hischool:'國立臺東大學附屬體育高中'},
			{value:'002', hischool:'國立臺東女中'},
			{value:'003', hischool:'國立臺東高中'},
			{value:'004', hischool:'國立關山工商'},
			{value:'005', hischool:'國立臺東高商'},
			{value:'006', hischool:'國立成功商水'},
			{value:'007', hischool:'臺東縣均一高中'},
			{value:'008', hischool:'私立育仁高中'},
			{value:'009', hischool:'私立公東高工'},
			{value:'010', hischool:'縣立蘭嶼高中'}
        ]
    },

	
    {
        city: '南投縣',
		value:'S',
        hischool: [
			{value:'001', hischool:'國立南投高中'},
			{value:'002', hischool:'國立中興高中'},
			{value:'003', hischool:'國立竹山高中'},
			{value:'004', hischool:'國立暨大附中'},
			{value:'005', hischool:'國立仁愛高農'},
			{value:'006', hischool:'國立埔里高工'},
			{value:'007', hischool:'國立南投高商'},
			{value:'008', hischool:'國立草屯商工'},
			{value:'009', hischool:'國立水里商工'},
			{value:'010', hischool:'私立五育高中'},
			{value:'011', hischool:'私立三育高中'},
			{value:'012', hischool:'私立弘明實驗高中'},
			{value:'013', hischool:'私立普台高中'},
			{value:'014', hischool:'私立同德家商'},
			{value:'015', hischool:'縣立旭光高中'}
        ]
    },


	{
        city: '澎湖縣',
		value:'T',
        hischool: [
			{value:'001', hischool:'國立馬公高中'},
			{value:'002', hischool:'國立澎湖海事水產'}
        ]
    },


	{
        city: '金門縣',
		value:'U',
        hischool: [
			{value:'001', hischool:'國立金門高中'},
			{value:'002', hischool:'國立金門農工'},
        ]
    },

	
	{
        city: '連江縣',
		value:'V',
        hischool: [
			{value:'001', hischool:'國立馬祖高中'}
        ]
    }
]

$("#conference").append("<option value=''>請選擇</option>");

AreaArr.filter(function(data){
  $("#conference").append(`<option value='${data.value}'>${data.conference}</option>`);
});


$("#conference").change(function () {
    const val = $("#conference").val();
    const arr = AreaArr.find(x => x.value === val);
    $("#city").find('option').remove();
	$("#hischool").find('option').remove();
	$("#city").append("<option value=''>請選擇</option>");
    arr.confmembers.filter(function (data) {
        $("#city").append(`<option value='${data.value}'>${data.city}</option>`);
    })
});

$("#city").change(function () {
    const val = $("#city").val();
    const arr = histockArr.find(x => x.value === val);
    $("#hischool").find('option').remove();
	$("#hischool").append("<option value=''>請選擇</option>");
    arr.hischool.filter(function (data) {
        $("#hischool").append(`<option value='${data.value}'>${data.hischool}</option>`);
    })
});