<?php

namespace Opendi\Lang;

class CharacterMap
{
    /**
     * Maps non-ASCII characters to ASCII equivalents (can be more than one
     * char) for transliteration.
     */
    public static $map = [
        'À' => 'A', // 00C0
        'Á' => 'A', // 00C1
        'Â' => 'A', // 00C2
        'Ã' => 'A', // 00C3
        'Ä' => 'Ae', // 00C4
        'Å' => 'A', // 00C5
        'Æ' => 'Ae', // 00C6
        'Ç' => 'C', // 00C7
        'È' => 'E', // 00C8
        'É' => 'E', // 00C9
        'Ê' => 'E', // 00CA
        'Ë' => 'E', // 00CB
        'Ì' => 'I', // 00CC
        'Í' => 'I', // 00CD
        'Î' => 'I', // 00CE
        'Ï' => 'I', // 00CF
        'Ð' => 'D', // 00D0  http://de.wikipedia.org/wiki/%C3%90
        'Ñ' => 'N', // 00D1
        'Ò' => 'O', // 00D2
        'Ó' => 'O', // 00D3
        'Ô' => 'O', // 00D4
        'Õ' => 'O', // 00D5
        'Ö' => 'Oe', // 00D6
        'Ø' => 'Oe', // 00D8  http://de.wikipedia.org/wiki/%C3%98
        'Ù' => 'U', // 00D9
        'Ú' => 'U', // 00DA
        'Û' => 'U', // 00DB
        'Ü' => 'Ue', // 00DC
        'Ý' => 'Y', // 00DD
        'Þ' => 'Th', // 00DE  http://de.wikipedia.org/wiki/%C3%9E
        'ß' => 'ss', // 00DF
        'à' => 'a', // 00E0
        'á' => 'a', // 00E1
        'â' => 'a', // 00E2
        'ã' => 'a', // 00E3
        'ä' => 'ae', // 00E4
        'å' => 'a', // 00E5
        'æ' => 'ae', // 00E6
        'ç' => 'c', // 00E7
        'è' => 'e', // 00E8
        'é' => 'e', // 00E9
        'ê' => 'e', // 00EA
        'ë' => 'e', // 00EB
        'ì' => 'i', // 00EC
        'í' => 'i', // 00ED
        'î' => 'i', // 00EE
        'ï' => 'i', // 00EF
        'ð' => 'd', // 00F0  http://de.wikipedia.org/wiki/%C3%90
        'ñ' => 'n', // 00F1
        'ò' => 'o', // 00F2
        'ó' => 'o', // 00F3
        'ô' => 'o', // 00F4
        'õ' => 'o', // 00F5
        'ö' => 'oe', // 00F6
        'ø' => 'oe', // 00F8  http://de.wikipedia.org/wiki/%C3%98
        'ù' => 'u', // 00F9
        'ú' => 'u', // 00FA
        'û' => 'u', // 00FB
        'ü' => 'ue', // 00FC
        'ý' => 'y', // 00FD
        'þ' => 'th', // 00FE  http://de.wikipedia.org/wiki/%C3%9E
        'ÿ' => 'y', // 00FF
        'Ā' => 'A', // 0100
        'ā' => 'a', // 0101
        'Ă' => 'A', // 0102
        'ă' => 'a', // 0103
        'Ą' => 'A', // 0104
        'ą' => 'a', // 0105
        'Ć' => 'C', // 0106
        'ć' => 'c', // 0107
        'Ĉ' => 'C', // 0108
        'ĉ' => 'c', // 0109
        'Ċ' => 'C', // 010A
        'ċ' => 'c', // 010B
        'Č' => 'C', // 010C
        'č' => 'c', // 010D
        'Ď' => 'D', // 010E
        'ď' => 'd', // 010F
        'Đ' => 'D', // 0110
        'đ' => 'd', // 0111
        'Ē' => 'E', // 0112
        'ē' => 'e', // 0113
        'Ĕ' => 'E', // 0114
        'ĕ' => 'e', // 0115
        'Ė' => 'E', // 0116
        'ė' => 'e', // 0117
        'Ę' => 'E', // 0118
        'ę' => 'e', // 0119
        'Ě' => 'E', // 011A
        'ě' => 'e', // 011B
        'Ĝ' => 'G', // 011C
        'ĝ' => 'g', // 011D
        'Ğ' => 'G', // 011E
        'ğ' => 'g', // 011F
        'Ġ' => 'G', // 0120
        'ġ' => 'g', // 0121
        'Ģ' => 'G', // 0122
        'ģ' => 'g', // 0123
        'Ĥ' => 'H', // 0124
        'ĥ' => 'h', // 0125
        'Ħ' => 'H', // 0126
        'ħ' => 'h', // 0127
        'Ĩ' => 'I', // 0128
        'ĩ' => 'i', // 0129
        'Ī' => 'I', // 012A
        'ī' => 'i', // 012B
        'Ĭ' => 'I', // 012C
        'ĭ' => 'i', // 012D
        'Į' => 'I', // 012E
        'į' => 'i', // 012F
        'İ' => 'I', // 0130
        'ı' => 'i', // 0131
        'Ĳ' => 'IJ', // 0132  http://de.wikipedia.org/wiki/IJ -> komplette Grossschreibung
        'ĳ' => 'ij', // 0133
        'Ĵ' => 'J', // 0134
        'ĵ' => 'j', // 0135
        'Ķ' => 'K', // 0136
        'ķ' => 'k', // 0137
        'ĸ' => 'k', // 0138
        'Ĺ' => 'L', // 0139
        'ĺ' => 'l', // 013A
        'Ļ' => 'L', // 013B
        'ļ' => 'l', // 013C
        'Ľ' => 'L', // 013D
        'ľ' => 'l', // 013E
        'Ŀ' => 'L', // 013F
        'ŀ' => 'l', // 0140
        'Ł' => 'L', // 0141
        'ł' => 'l', // 0142
        'Ń' => 'N', // 0143
        'ń' => 'n', // 0144
        'Ņ' => 'N', // 0145
        'ņ' => 'n', // 0146
        'Ň' => 'N', // 0147
        'ň' => 'n', // 0148
        'ŉ' => 'n', // 0149
        'Ŋ' => 'N', // 014A
        'ŋ' => 'n', // 014B
        'Ō' => 'O', // 014C
        'ō' => 'o', // 014D
        'Ŏ' => 'O', // 014E
        'ŏ' => 'o', // 014F
        'Ő' => 'Oe', // 0150
        'ő' => 'oe', // 0151
        'Œ' => 'Oe', // 0152
        'œ' => 'oe', // 0153
        'Ŕ' => 'R', // 0154
        'ŕ' => 'r', // 0155
        'Ŗ' => 'R', // 0156
        'ŗ' => 'r', // 0157
        'Ř' => 'R', // 0158
        'ř' => 'r', // 0159
        'Ś' => 'S', // 015A
        'ś' => 's', // 015B
        'Ŝ' => 'S', // 015C
        'ŝ' => 's', // 015D
        'Ş' => 'S', // 015E
        'ş' => 's', // 015F
        'Š' => 'S', // 0160
        'š' => 's', // 0161
        'Ţ' => 'T', // 0162
        'ţ' => 't', // 0163
        'Ť' => 'T', // 0164
        'ť' => 't', // 0165
        'Ŧ' => 'T', // 0166
        'ŧ' => 't', // 0167
        'Ũ' => 'U', // 0168
        'ũ' => 'u', // 0169
        'Ū' => 'U', // 016A
        'ū' => 'u', // 016B
        'Ŭ' => 'U', // 016C
        'ŭ' => 'u', // 016D
        'Ů' => 'U', // 016E
        'ů' => 'u', // 016F
        'Ű' => 'Ue', // 0170
        'ű' => 'ue', // 0171
        'Ų' => 'U', // 0172
        'ų' => 'u', // 0173
        'Ŵ' => 'W', // 0174
        'ŵ' => 'w', // 0175
        'Ŷ' => 'Y', // 0176
        'ŷ' => 'y', // 0177
        'Ÿ' => 'Y', // 0178
        'Ź' => 'Z', // 0179
        'ź' => 'z', // 017A
        'Ż' => 'Z', // 017B
        'ż' => 'z', // 017C
        'Ž' => 'Z', // 017D
        'ž' => 'z', // 017E
        'ſ' => 's', // 017F
        // 0180 - 018E missing
        'Ə' => 'E', // 018F        Arial  only             http://de.wikipedia.org/wiki/Schwa
        // 0190 - 0191 missing
        'ƒ' => 'f', // 0192
        // 0193 - 019F missing
        'Ơ' => 'O', // 01A0
        'ơ' => 'o', // 01A1
        // 01A2 - 01AE missing
        'Ư' => 'U', // 01AF
        'ư' => 'u', // 01B0
        // 01B1 - 01CC missing
        'Ǎ' => 'A', // 01CD        Arial only
        'ǎ' => 'a', // 01CE        Arial only
        'Ǐ' => 'I', // 01CF        Arial only
        'ǐ' => 'i', // 01D0        Arial only
        'Ǒ' => 'O', // 01D1        Arial only
        'ǒ' => 'o', // 01D2        Arial only
        'Ǔ' => 'U', // 01D3        Arial only
        'ǔ' => 'u', // 01D4        Arial only
        'Ǖ' => 'U', // 01D5        Arial only
        'ǖ' => 'u', // 01D6        Arial only
        'Ǘ' => 'U', // 01D7        Arial only
        'ǘ' => 'u', // 01D8        Arial only
        'Ǚ' => 'U', // 01D9        Arial only
        'ǚ' => 'u', // 01DA        Arial only
        'Ǜ' => 'U', // 01DB        Arial only
        'ǜ' => 'u', // 01DC        Arial only
        // 01DE - 01F9 missing
        'Ǻ' => 'A', // 01FA
        'ǻ' => 'a', // 01FB
        'Ǽ' => 'Ae', // 01FC
        'ǽ' => 'ae', // 01FD
        'Ǿ' => 'O', // 01FE
        'ǿ' => 'o', // 01FF
        // 0200 - 0258 missing
        'ə' => 'e', // 0259        Arial  only             http://de.wikipedia.org/wiki/Schwa
        // 025A - 0385 missing or no Chars

        // Start Griechisch
        // Umsetzung in Neugriechische Transkription
        // nach http://de.wikipedia.org/wiki/Griechisches_Alphabet
        'Ά' => 'A', // 0386
        // 0387 no Char
        'Έ' => 'E', // 0388
        'Ή' => 'H', // 0389
        'Ί' => 'I', // 038A
        // 038B missing
        'Ό' => 'O', // 038C
        // 038D missing
        'Ύ' => 'Y', // 038E
        'Ώ' => 'O', // 038F
        'ΐ' => 'i', // 0390
        'Α' => 'A', // 0391
        'Β' => 'V', // 0392
        'Γ' => 'G', // 0393
        'Δ' => 'D', // 0394
        'Ε' => 'E', // 0395
        'Ζ' => 'Z', // 0396
        'Η' => 'H', // 0397
        'Θ' => 'Th', // 0398
        'Ι' => 'I', // 0399
        'Κ' => 'K', // 039A
        'Λ' => 'L', // 039B
        'Μ' => 'M', // 039C
        'Ν' => 'N', // 039D
        'Ξ' => 'X', // 039E
        'Ο' => 'O', // 039F
        'Π' => 'P', // 03A0
        'Ρ' => 'R', // 03A1
        // 03A2 missing
        'Σ' => 'S', // 03A3
        'Τ' => 'T', // 03A4
        'Υ' => 'Y', // 03A5
        'Φ' => 'F', // 03A6
        'Χ' => 'Ch', // 03A7
        'Ψ' => 'Ps', // 03A8
        'Ω' => 'O', // 03A9
        'Ϊ' => 'I', // 03AA
        'Ϋ' => 'Y', // 03AB
        'ά' => 'a', // 03AC
        'έ' => 'e', // 03AD
        'ή' => 'i', // 03AE
        'ί' => 'i', // 03AF
        'ΰ' => 'y', // 03B0
        'α' => 'a', // 03B1
        'β' => 'v', // 03B2
        'γ' => 'g', // 03B3
        'δ' => 'd', // 03B4
        'ε' => 'e', // 03B5
        'ζ' => 'z', // 03B6
        'η' => 'h', // 03B7
        'θ' => 'th', // 03B8
        'ι' => 'i', // 03B9
        'κ' => 'k', // 03BA
        'λ' => 'l', // 03BB
        'μ' => 'm', // 03BC
        'ν' => 'n', // 03BD
        'ξ' => 'x', // 03BE
        'ο' => 'o', // 03BF
        'π' => 'p', // 03C0
        'ρ' => 'r', // 03C1
        'ς' => 's', // 03C2
        'σ' => 's', // 03C3
        'τ' => 't', // 03C4
        'υ' => 'y', // 03C5
        'φ' => 's', // 03C6
        'χ' => 'ch', // 03C7
        'ψ' => 'ps', // 03C8
        'ω' => 'o', // 03C9
        'ϊ' => 'i', // 03CA
        'ϋ' => 'y', // 03CB
        'ό' => 'o', // 03CC
        'ύ' => 'y', // 03CD
        'ώ' => 'o', // 03CE
        // Ende Griechisch

        // 03CF - 0400 missing

        // Start Kyrillisch
        'Ё' => 'Io', // 0401
        'Ђ' => 'D', // 0402
        'Ѓ' => 'G', // 0403
        'Є' => 'Ae', // 0404
        'Ѕ' => 'Dz', // 0405
        'І' => 'I', // 0406
        'Ї' => 'Ye', // 0407
        'Ј' => 'Je', // 0408
        'Љ' => 'Le', // 0409
        'Њ' => 'Ne', // 040A
        'Ћ' => 'Tsch', // 040B
        'Ќ' => 'K', // 040D
        // 040D missing
        'Ў' => 'U', // 040E
        'Џ' => 'Dz', // 040F
        'А' => 'A', // 0410
        'Б' => 'B', // 0411
        'В' => 'W', // 0412
        'Г' => 'G', // 0413
        'Д' => 'D', // 0414
        'Е' => 'E', // 0415
        'Ж' => 'Zh', // 0416
        'З' => 'Z', // 0417
        'И' => 'I', // 0418
        'Й' => 'I', // 0419
        'К' => 'K', // 041A
        'Л' => 'L', // 041B
        'М' => 'M', // 041C
        'Н' => 'N', // 041D
        'О' => 'O', // 041E
        'П' => 'P', // 041F
        'Р' => 'R', // 0420
        'С' => 'S', // 0421
        'Т' => 'T', // 0422
        'У' => 'U', // 0423
        'Ф' => 'F', // 0424
        'Х' => 'H', // 0425
        'Ц' => 'Z', // 0426
        'Ч' => 'Tsch', // 0427
        'Ш' => 'Sch', // 0428
        'Щ' => 'Sch', // 0429
        // 042A: kyrillisches Hartzeichen   slawa@sbb
        'Ы' => 'I', // 042B
        // 042C: kyrillisches Weichzeichen  slawa@sbb
        'Э' => 'E', // 042D
        'Ю' => 'Ju', // 042E
        'Я' => 'Ja', // 042F
        'а' => 'a', // 0430
        'б' => 'b', // 0431
        'в' => 'w', // 0432
        'г' => 'g', // 0433
        'д' => 'd', // 0434
        'е' => 'e', // 0435
        'ж' => 'zh', // 0436
        'з' => 'z', // 0437
        'и' => 'i', // 0438
        'й' => 'i', // 0439
        'к' => 'k', // 043A
        'л' => 'l', // 043B
        'м' => 'm', // 043C
        'н' => 'n', // 043D
        'о' => 'o', // 043E
        'п' => 'p', // 043F
        'р' => 'r', // 0440
        'с' => 's', // 0441
        'т' => 't', // 0442
        'у' => 'u', // 0443
        'ф' => 'f', // 0444
        'х' => 'h', // 0445
        'ц' => 'z', // 0446
        'ч' => 'tsch', // 0447
        'ш' => 'sch', // 0448
        'щ' => 'sch', // 0449
        // 044A: kyrillisches Hartzeichen   slawa@sbb
        'ы' => 'i', // 044B
        // 044C: kyrillisches Weichzeichen  slawa@sbb
        'э' => 'e', // 044D
        'ю' => 'ju', // 044E
        'я' => 'ja', // 044F
        // 0450 missing
        'ё' => 'jo', // 0451
        'ђ' => 'd', // 0452
        'ѓ' => 'g', // 0453
        'є' => 'ae', // 0454
        'ѕ' => 'dz', // 0455
        'і' => 'i', // 0456
        'ї' => 'ye', // 0457
        'ј' => 'je', // 0458
        'љ' => 'le', // 0459
        'њ' => 'ne', // 045A
        'ћ' => 'tsch', // 045B
        'ќ' => 'k', // 045D
        // 045D missing
        'ў' => 'u', // 045E
        'џ' => 'dz', // 045F
        // 0460 - 048F missing
        'Ґ' => 'G', // 0490
        'ґ' => 'g', // 0491
        'Ғ' => 'G', // 0492        Arial only
        'ғ' => 'g', // 0493        Arial only
        // 0494 - 0495 missing
        'Җ' => 'Zh', // 0496       Arial only
        'җ' => 'zh', // 0497       Arial only
        // 0498 - 0499 missing
        'Қ' => 'K', // 049A        Arial only
        'қ' => 'k', // 049B        Arial only
        'Ҝ' => 'K', // 049C        Arial only
        'ҝ' => 'k', // 049D        Arial only
        // 049E - 04A1 missing
        'Ң' => 'N', // 04A2        Arial only
        'ң' => 'n', // 04A3        Arial only
        // 04A4 - 04AD missing
        'Ү' => 'U', // 04AE        Arial only
        'ү' => 'u', // 04AF        Arial only
        'Ұ' => 'U', // 04B0        Arial only
        'ұ' => 'u', // 04B1        Arial only
        'Ҳ' => 'H', // 04B2        Arial only
        'ҳ' => 'h', // 04B3        Arial only
        // 04B4 - 04B7 missing
        'Ҹ' => 'Tsch', // 04B8     Arial only
        'ҹ' => 'tsch', // 04B9     Arial only
        'Һ' => 'Sch', // 04BA      Arial only
        'һ' => 'sch', // 04BB      Arial only
        // 04BC - 04D7 missing
        'Ә' => 'E', // 04D8        Arial only
        'ә' => 'e', // 04D9        Arial only
        // 04DA - 04E7 missing
        'Ө' => 'O', // 04E8        Arial only
        'ө' => 'o', // 04E9        Arial only
        // Ende Kyrillisch

        // 04EA - 1E7F missing or hebrew/arabic in Arial

        'Ẁ' => 'W', // 1E80
        'ẁ' => 'w', // 1E81
        'Ẃ' => 'W', // 1E82
        'ẃ' => 'w', // 1E83
        'Ẅ' => 'W', // 1E84
        'ẅ' => 'w', // 1E85
        // 1E86 - 1E9F missing
        'Ạ' => 'A', // 1EA0
        'ạ' => 'a', // 1EA1
        'Ả' => 'A', // 1EA2
        'ả' => 'a', // 1EA3
        'Ấ' => 'A', // 1EA4
        'ấ' => 'a', // 1EA5
        'Ầ' => 'A', // 1EA6
        'ầ' => 'a', // 1EA7
        'Ẩ' => 'A', // 1EA8
        'ẩ' => 'a', // 1EA9
        'Ẫ' => 'A', // 1EAA
        'ẫ' => 'a', // 1EAB
        'Ậ' => 'A', // 1EAC
        'ậ' => 'a', // 1EAD
        'Ắ' => 'A', // 1EAE
        'ắ' => 'a', // 1EAF
        'Ằ' => 'A', // 1EB0
        'ằ' => 'a', // 1EB1
        'Ẳ' => 'A', // 1EB2
        'ẳ' => 'a', // 1EB3
        'Ẵ' => 'A', // 1EB4
        'ẵ' => 'a', // 1EB5
        'Ặ' => 'A', // 1EB6
        'ặ' => 'a', // 1EB7
        'Ẹ' => 'E', // 1EB8
        'ẹ' => 'e', // 1EB9
        'Ẻ' => 'E', // 1EBA
        'ẻ' => 'e', // 1EBB
        'Ẽ' => 'E', // 1EBC
        'ẽ' => 'e', // 1EBD
        'Ế' => 'E', // 1EBE
        'ế' => 'e', // 1EBF
        'Ề' => 'E', // 1EC0
        'ề' => 'e', // 1EC1
        'Ể' => 'E', // 1EC2
        'ể' => 'e', // 1EC3
        'Ễ' => 'E', // 1EC4
        'ễ' => 'e', // 1EC5
        'Ệ' => 'E', // 1EC6
        'ệ' => 'e', // 1EC7
        'Ỉ' => 'I', // 1EC8
        'ỉ' => 'i', // 1EC9
        'Ị' => 'I', // 1ECA
        'ị' => 'i', // 1ECB
        'Ọ' => 'O', // 1ECC
        'ọ' => 'o', // 1ECD
        'Ỏ' => 'O', // 1ECE
        'ỏ' => 'o', // 1ECF
        'Ố' => 'O', // 1ED0
        'ố' => 'o', // 1ED1
        'Ồ' => 'O', // 1ED2
        'ồ' => 'o', // 1ED3
        'Ổ' => 'O', // 1ED4
        'ổ' => 'o', // 1ED5
        'Ỗ' => 'O', // 1ED6
        'ỗ' => 'o', // 1ED7
        'Ộ' => 'O', // 1ED8
        'ộ' => 'o', // 1ED9
        'Ớ' => 'O', // 1EDA
        'ớ' => 'o', // 1EDB
        'Ờ' => 'O', // 1EDC
        'ờ' => 'o', // 1EDD
        'Ở' => 'O', // 1EDE
        'ở' => 'o', // 1EDF
        'Ỡ' => 'O', // 1EE0
        'ỡ' => 'o', // 1EE1
        'Ợ' => 'O', // 1EE2
        'ợ' => 'o', // 1EE3
        'Ụ' => 'U', // 1EE4
        'ụ' => 'u', // 1EE5
        'Ủ' => 'U', // 1EE6
        'ủ' => 'u', // 1EE7
        'Ứ' => 'U', // 1EE8
        'ứ' => 'u', // 1EE9
        'Ừ' => 'U', // 1EEA
        'ừ' => 'u', // 1EEB
        'Ử' => 'U', // 1EEC
        'ử' => 'u', // 1EED
        'Ữ' => 'U', // 1EEE
        'ữ' => 'u', // 1EEF
        'Ự' => 'U', // 1EF0
        'ự' => 'u', // 1EF1
        'Ỳ' => 'Y', // 1EF2
        'ỳ' => 'y', // 1EF3
        'Ỵ' => 'Y', // 1EF4
        'ỵ' => 'y', // 1EF5
        'Ỷ' => 'Y', // 1EF6
        'ỷ' => 'y', // 1EF7
        'Ỹ' => 'Y', // 1EF8
        'ỹ' => 'y', // 1EF9
        // 1EFA - FB00 missing or no chars
        'ﬁ' => 'fi', // FB01
        'ﬂ' => 'fl', // FB02
    ];

    public static function get()
    {
        return self::$map;
    }
}
