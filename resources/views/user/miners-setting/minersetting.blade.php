@extends('user.layouts.main')

@section('content')
	<div class="section section--head">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-6 offset-md-3 col-xl-4 offset-xl-4">
					<div class="section__title">
						<h1>Miner Setting</h1>
						<p>Configure miner: Update Your IP to match with the Miner IP</p>
					</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
<div class="section">
    <div class="container">
        <div class="row row--relative"><br><br>
            <div class="col-12">
                <!-- Success Notification -->
                @if(session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="form" method="POST" action="{{ route('user.miner.settings.save') }}">
                    @csrf
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="onMinerToggle" name="server_status" value="1" {{ auth()->user()->server_status ? 'checked' : '' }}>
                        <label class="form__label" for="onMinerToggle">Switch On Miner</label>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="form__group">
                                <label for="miner_location" class="form__label">Select Miner Location</label>
                                <select class="form__select" name="miner_location" id="miner_location" required>
                                    <option value="">-- Select Location --</option>
                                    @foreach($miners as $miner)
                                        <option value="{{ $miner->miner_location }}"
                                            {{ auth()->user()->miner_location === $miner->miner_location ? 'selected' : '' }}>
                                            {{ $miner->miner_location }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="form__group">
                                <label for="selected_ip" class="form__label">Miner IP</label>
                                <input type="text" id="selected_ip" class="form__input" value="{{ auth()->user()->miner_ip }}" disabled>
                            </div>
                        </div>

                        <!-- Real-Time Display for Up Time -->
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="form__group">
                                <label for="up_time" class="form__label">Up Time</label>
                                <input type="text" id="up_time" class="form__input" value="{{ auth()->user()->up_time }}" disabled>
                            </div>
                        </div>

                        <!-- Real-Time Display for Status -->
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="form__group">
                                <label for="status" class="form__label">Status</label>
                                <input type="text" id="status" class="form__input" value="{{ auth()->user()->status }}" disabled>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="form__group">
                                <label for="custom_ip" class="form__label">Configure IP to Sync</label>
                                <input type="text" name="miner_ip" class="form__input" id="custom_ip" value="{{ auth()->user()->miner_ip }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="form__btn form__btn--small">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // When the location is changed
        $('#miner_location').on('change', function () {
            var selectedLocation = $(this).val(); // Get selected location

            // Send AJAX request to get the miner IP, up_time, and status based on the location
            if (selectedLocation) {
                $.ajax({
                    url: '{{ route('user.miner.ip') }}', // Route to the controller method
                    method: 'GET',
                    data: { location: selectedLocation },
                    success: function(response) {
                        // If a miner IP is found, update the "Selected IP" field
                        if (response.miner_ip) {
                            $('#selected_ip').val(response.miner_ip);
                        } else {
                            $('#selected_ip').val('No IP found for this location');
                        }

                        // Update Up Time
                        if (response.up_time) {
                            $('#up_time').val(response.up_time);
                        } else {
                            $('#up_time').val('No up time available');
                        }

                        // Update Status
                        if (response.status) {
                            $('#status').val(response.status);
                        } else {
                            $('#status').val('No status available');
                        }
                    },
                    error: function() {
                        $('#selected_ip').val('Error fetching IP');
                        $('#up_time').val('Error fetching up time');
                        $('#status').val('Error fetching status');
                    }
                });
            } else {
                $('#selected_ip').val('');
                $('#up_time').val('');
                $('#status').val('');
            }
        });
    });
</script>

@endsection
