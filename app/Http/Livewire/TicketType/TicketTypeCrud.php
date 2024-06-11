<?php

namespace App\Http\Livewire\TicketType;

use Livewire\Component;
use App\Models\TicketType;
use Illuminate\Support\Facades\Validator;

class TicketTypeCrud extends Component
{
    public  $action, 
            $ticketType,
            $title,
            $name,
            $preVatPrice,
            $postVatPrice,
            $vat,
            $note,
            $pattern,
            $serial;

    public function getValidatorProperty() {
        $data = [
            'title' => $this->title,
            'name' => $this->name,
            'postVatPrice' => preg_replace("/[^0-9]/", "", $this->postVatPrice),
            'pattern' => $this->pattern,
            'serial' => $this->serial,
        ];

        $rules = [
            'title' => 'required',
            'name' => 'required',
            'postVatPrice' => 'required|gt:0',
            'pattern' => 'required|max:50',
            'serial' => 'required|max:50',
        ];

        $messages = [
            'title.required' => 'Chưa nhập tên loại vé',
            'name.required' => 'Chưa nhập tên hiển thị',
            'postVatPrice.required' => 'Chưa nhập giá sau thuế',
            'postVatPrice.gt' => 'Vui lòng nhập giá tiền lớn hơn 0',
            'pattern.required' => 'Chưa nhập mẫu số',
            'pattern.max' => 'Mẫu số không được quá 50 ký tự',
            'serial.required' => 'Chưa nhập ký hiệu',
            'serial.max' => 'Ký hiệu không được quá 50 ký tự',
        ];

        return Validator::make($data, $rules, $messages);
    }

    public function modalSetup($id) {
        if ($id == 0) {
            $this->action = 'create';
        } elseif ($id > 0) {
            $this->action = 'update';
        } else {
            $this->action = 'delete';
        }

        $this->ticketType = TicketType::find(abs($id));

        $this->getData();
    }

    public function getData() {
        $this->title = $this->ticketType->title ?? '';
        $this->name = $this->ticketType->name ?? '';
        $this->vat = $this->ticketType->vat ?? null;
        $this->postVatPrice = $this->ticketType->post_vat_price ?? '';
        $this->preVatPrice = $this->ticketType->pre_vat_price ?? 0;
        $this->note = $this->ticketType->note ?? '';
        $this->pattern = $this->ticketType->pattern ?? '';
        $this->serial = $this->ticketType->serial ?? '';

        $this->resetErrorBag();
    }

    public function preVatPriceCal() {
        $postVatPrice = preg_replace("/[^0-9]/", "", $this->postVatPrice );

        if ($postVatPrice == '') $postVatPrice = 0; 
        $preVatPrice = $postVatPrice * (1 - $this->vat ?? 0);

        $this->preVatPrice = number_format($preVatPrice, 0, '.', ',');
    }

    public function updatedPostVatPrice() {
        $this->preVatPriceCal();
    }

    public function updatedVat() {
        $this->preVatPriceCal();
    }

    public function getParams() {
        return [
            'title' => trim($this->title),
            'name' => trim($this->name),
            'post_vat_price' => preg_replace("/[^0-9]/", "", $this->postVatPrice),
            'pre_vat_price' => preg_replace("/[^0-9]/", "", $this->preVatPrice),
            'vat' => $this->vat,
            'note' => trim($this->note),
            'pattern' => trim($this->pattern),
            'serial' => trim($this->serial),
            'is_actived' => true,
        ];
    }

    public function create() {
        $this->validator->validate();
            
        $this->preVatPriceCal();
        TicketType::create($this->getParams());

        $this->emitTo('ticket-type.ticket-type-list', 'refreshList');
        $this->dispatchBrowserEvent('closeCrudTicketType');
    }

    public function update() {
        $this->validator->validate();
            
        $this->preVatPriceCal();
        $this->ticketType->update($this->getParams());

        $this->emitTo('ticket-type.ticket-type-list', 'refreshList');
        $this->dispatchBrowserEvent('closeCrudTicketType');
    }

    public function delete() {
        $this->ticketType->delete();

        $this->emitTo('ticket-type.ticket-type-list', 'refreshList');
        $this->dispatchBrowserEvent('closeCrudTicketType');
    }

    public function render()
    {
        return view('admins.tickets.type.livewire.ticket-type-crud');
    }
}
