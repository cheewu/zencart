var BvGlobalCounter = function() {};
BvGlobalCounter.value = 0;

function bvGetMouseX(e) {
	var tempX;
	if (document.all) {
	tempX = e.clientX + document.body.scrollLeft;
	} else {
	tempX = e.pageX;
	}
	
	if (tempX < 0){
	tempX = 0;
	}
	return tempX;
}

function BvRatingBar(ratedItem){
	
	var _prepend = ratedItem;	
	var _BGWidth = 15;	
	var _BGHeight = 14;	
	var _specificity = 1;	
	var _maxRating = 5;	
	var _minRating = 1;	
	
	var _ratingType = "Stars";
	var _ratingTypeSingular = "Star";
	
	var _sparkleImage = baseURL+"includes/templates/lightinthebox/images/icon/sparkle.gif";
	var _rating;
	
	var _displayItemOverride = "score_title";
	var _inputItemOverride = "product_score";
	
	
	var _isMouseDown = false;
	
	var _hasValueSet = false;
	
	
	this.initializeValue = function (givenValue) {
		_hasValueSet = true;
		var ratingValue = (Math.ceil(givenValue/_specificity)* 100 *_specificity)/100;
		if(ratingValue > _maxRating){
		ratingValue = _maxRating;
		} else if(ratingValue < _minRating){
		ratingValue = _minRating;
		}
		_rating = ratingValue;
		var tableWidth = ratingValue * _BGWidth;
		window.$(ratedItem + "Filled").style.width = tableWidth + "px";
		//change the input value
		if(_inputItemOverride){
			var inputItemOverrideElement = $(_inputItemOverride);
			if( inputItemOverrideElement) {
			inputItemOverrideElement.value = _rating;
			}
		}
		//display the value of show text
		if(_displayItemOverride){
		if($(_displayItemOverride)){
			if (_rating == 1){
			$(_displayItemOverride).innerHTML = _rating + " " + _ratingTypeSingular;
			} else {
			$(_displayItemOverride).innerHTML = _rating + " " + _ratingType;
			}
		}
		}
	};
	

	this.resizeTable = function (event, table) {
		var ratingBarElement = $(_prepend + 'RatingBar');
		var tableWidth = ratingBarElement.style.width;
		
		var scaleAmt = bvGetMouseX(event) - bvFindPosX(ratingBarElement);		
		var ratingValue = (Math.ceil(scaleAmt/_BGWidth/_specificity) * 100 * _specificity)/100;
		
		if(ratingValue > _maxRating){
		ratingValue = _maxRating;
		} else if(ratingValue < _minRating){
		ratingValue = _minRating;
		}
		
		tableWidth = ratingValue * _BGWidth;
		
		if(tableWidth < 1){
		tableWidth = 1;
		}
		
		$(table).style.width = tableWidth + "px";
	
		
		_rating = ratingValue;
	};
	
	
	this.setRating = function (event) {
		this.updateRating(event, _prepend + 'Filled');
		_hasValueSet = true;
	};
	
	this.updateRating = function (event, table, ignoreInput) {
		this.resizeTable(event, table);
		if(!ignoreInput){
		if(_inputItemOverride){
			var inputItemOverrideElement = $(_inputItemOverride);
			if(inputItemOverrideElement){
			inputItemOverrideElement.value = _rating;
			}
		}
		}
	
		if(_displayItemOverride){
		var displayItemOverrideElement = $(_displayItemOverride);
		if( displayItemOverrideElement){
		if (_rating == 1){
		displayItemOverrideElement.innerHTML = _rating + " " + _ratingTypeSingular;
		} else {
		displayItemOverrideElement.innerHTML = _rating + " " + _ratingType;
		}
		}
		}
	};
	
	
	this.startSlide = function () {
		_isMouseDown = true;
	};
	
	
	this.stopSlide = function () {
		if(_isMouseDown){
			var backgroundPath = _sparkleImage + '?i=' + BvGlobalCounter.value++;
			$(_prepend + 'Filled').style.background = "url(" + backgroundPath +")";
			_isMouseDown = false;
		}
	};
	
	
	this.doSlide = function (event) {
		if(_isMouseDown){
		this.updateRating(event, _prepend + "Filled");
		
		_hasValueSet = true;
		
		} else if(!_hasValueSet){
		this.updateRating(event, _prepend + "Hover", true);
		}
	};
	
	
	this.resetHover = function () {
		
		$(_prepend + "Hover").style.width = '1px';
	
		if(!_hasValueSet){
		if(_displayItemOverride){
		var displayItemOverrideElement = $(_displayItemOverride);
		if(displayItemOverrideElement){
		displayItemOverrideElement.innerHTML = "";
		}
		} 
		}
	}
}
function bvFindPosX(obj){
var curleft = 0;
if (obj.offsetParent){
while (obj){
curleft += obj.offsetLeft;
obj = obj.offsetParent;
}
} else if (obj.x) {
curleft += obj.x;
}
return curleft;
}
