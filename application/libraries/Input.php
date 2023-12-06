<?php

/*
metronic input

<?= ((new Input())->render()); ?>

<?= ((new Input())
->setType('number')
->setName('minAge')
->setPlaceholder('minAge')
->render()); ?>

*/
class Input{
	public $type="text";
	public $name="field";
	public $value=1;
	public $placeholder="field";

	public $min=0;

	function render(){
		$type = $this->getType();
		$name = $this->getName();
		$value = $this->getValue();
		$placeholder = $this->getPlaceholder();
		$min = $this->getMin();

		// return `1`;
		return <<< HTML
			<!--begin::Dialer-->
			<div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="$min"
				data-kt-dialer-max="80" data-kt-dialer-step="5"
				data-kt-dialer-decimals="0">
				<!--begin::Decrease control-->
				<button type="button"
					class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
					data-kt-dialer-control="decrease">
					<!--begin::Svg Icon | path: icons/duotune/general/gen042.svg-->
					<span class="svg-icon svg-icon-1">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<rect opacity="0.3" x="2" y="2" width="20" height="20"
								rx="10" fill="currentColor" />
							<rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
								fill="currentColor" />
						</svg>
					</span>
					<!--end::Svg Icon-->
				</button>
				<!--end::Decrease control-->
				<!--begin::Input control-->
				<input type="$type"
					class="form-control form-control-solid border-0 ps-12"
					data-kt-dialer-control="input" placeholder="$placeholder"
					name="$name" readonly="readonly" value="$value"/>
				<!--end::Input control-->
				<!--begin::Increase control-->
				<button type="button"
					class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
					data-kt-dialer-control="increase">
					<!--begin::Svg Icon | path: icons/duotune/general/gen041.svg-->
					<span class="svg-icon svg-icon-1">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<rect opacity="0.3" x="2" y="2" width="20" height="20"
								rx="10" fill="currentColor" />
							<rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
								transform="rotate(-90 10.8891 17.8033)"
								fill="currentColor" />
							<rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
								fill="currentColor" />
						</svg>
					</span>
					<!--end::Svg Icon-->
				</button>
				<!--end::Increase control-->
			</div> <!--end::Dialer-->
		HTML;
	}

	/**
	 * Get the value of placeholder
	 */ 
	public function getPlaceholder()
	{
		return $this->placeholder;
	}

	/**
	 * Set the value of placeholder
	 *
	 * @return  self
	 */ 
	public function setPlaceholder($placeholder)
	{
		$this->placeholder = $placeholder;

		return $this;
	}

	/**
	 * Get the value of value
	 */ 
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Set the value of value
	 *
	 * @return  self
	 */ 
	public function setValue($value)
	{
		$this->value = $value;

		return $this;
	}

	/**
	 * Get the value of name
	 */ 
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of name
	 *
	 * @return  self
	 */ 
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get the value of type
	 */ 
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set the value of type
	 *
	 * @return  self
	 */ 
	public function setType($type)
	{
		$this->type = $type;

		return $this;
	}

	/**
	 * Get the value of min
	 */ 
	public function getMin()
	{
		return $this->min;
	}

	/**
	 * Set the value of min
	 *
	 * @return  self
	 */ 
	public function setMin($min)
	{
		$this->min = $min;

		return $this;
	}
}