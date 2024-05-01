class Ajax {
    constructor(url) {
        this.url = url;

        this.setSuccess();
        this.setError();
        this.setAny();
        this.setData();
    }

    setSuccess(callback = () => { }) {
        this.success = callback;
        return this;
    }

    setError(callback = () => { }) {
        this.error = callback;
        return this;
    }

    setAny(callback = () => { }) {
        this.any = callback;
        return this;
    }

    showLoading() {
        // aqui exibe a animação de carregar
    }

    closeLoading() {
        // aqui esconde a animação de carregar
    }

    setData(data = null) {
        this.data = data;
    }

    run(data = null) {
        let content = data || this.data;
        this.showLoading();
        let that = this;

        $.ajax({
            url: this.url,
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: content,
            success: function (response) {
                that.success(response);
                that.any(response);
                that.closeLoading();
            },
            error: function (response) {
                that.error(response);
                that.any(response);
                that.closeLoading();
            }
        });
    }
}
