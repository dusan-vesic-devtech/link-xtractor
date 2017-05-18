# link-xtractor
Website link extractor

## Installation
```
composer require vesic/link-xtractor
```

## Usage
```
$xtractor = new LinkXtractor;
$xtractor->setUrl($url);
$links = $xtractor->getResults(); // [[0] => link, [1] => link-text], ...]
```
