Opendi Lang Changelog
=====================

1.0.0 (2015-12-08)
------------------

BC Breaks:

* Rename class `String` to `StringUtils` since `String` is reserved in PHP 7
* Rename class `Arry` to `ArrayUtils` to keep naming consistent

0.3.9 (2015-11-27)
------------------

* Add: `String::replaceNonBmp()`

0.3.8 (2015-05-20)
------------------

* Add: guarantee set order in CloneProperties (props first, then setters)

0.3.7 (2015-05-08)
------------------

* Add: support for setters and before closure in the CloneProperties trait

0.3.6 (2015-05-08)
------------------

* Added `JsonWriter` class

0.3.5 (2015-02-02)
------------------

* Added `String::oneLiner()`
* Modified `String::mostSimilar()` to use `similar_text()` instead of
  `levenshtein()`
* Modified `String::translit()` to accept non-string scalars

0.3.4 (2014-11-07)
------------------

* Fixed CloneProperties trait to use late static binding which allows it to be
  used on a class and work on it's subclasses.
* Improved tests

0.3.3 (2014-09-25)
------------------

* Added `Json::load()` and `Json::dump()`
* Added `String::translit()`

0.3.2 (2014-07-21)
------------------

* Added `Json` helper class

0.3.1 (2014-07-14)
------------------

* Added special handling for german characters in `String::slugify()`

0.3.0 (2014-06-06)
------------------

Features:

* Added `String::slugify()`
* Moved to PSR4 for autoloading
* Moved to PSR2 code style
