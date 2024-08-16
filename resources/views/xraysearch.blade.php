<!-- resources/views/xraysearch.blade.php -->

@extends('layouts.x_ray_search_layout')

@section('title', 'X-Ray Search')

@section('content')
<!-- Search Filters -->
<div class="row">
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="card shadow stickyCard">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                <h6 class="m-0 font-weight-bold text-primary">Search Filters</h6>
            </div>
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="people-tab" data-toggle="tab" href="#people" role="tab"
                        aria-controls="people" aria-selected="true"><i class="fas fa-users"></i> People</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab"
                        aria-controls="account" aria-selected="false"><i class="fas fa-briefcase"></i> Account</a>
                </li>
            </ul>
            <!-- Card Body -->
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="people" role="tabpanel" aria-labelledby="people-tab">


                        <form id="profileSearch" class="user" onsubmit="event.preventDefault(); performSearch();">
                            <div class="form-group">
                                <input name="name" type="text" class="form-control form-control-search" id="name"
                                    placeholder="Name" />
                            </div>
                            <div class="location-group">
                                <div class="form-group">
                                    <select class="search-select2 country-select" name="country" id="country">
                                        <!-- Country options will be populated here -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="search-select2  state-select" name="state" id="state">
                                        <!-- State options will be populated here -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="search-select2 city-select" name="city" id="city">
                                        <!-- City options will be populated here -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="company" type="text" class="form-control form-control-search" id="company"
                                    placeholder="Company" />
                            </div>
                            <div class="form-group">
                                <input name="jobtitle" type="text" class="form-control form-control-search"
                                    id="jobTitle" placeholder="Job Title" />
                            </div>
                            <div class="form-group">
                                <input name="username" id="username" type="text"
                                    class="form-control form-control-search" id="linkedInLink"
                                    placeholder="LinkedIn Link" />
                            </div>
                            <hr />
                            <button class="btn btn-primary btn-search btn-block" type="submit">Search
                                People</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <form id="companySearch" class="user">
                            <div class="form-group">
                                <input name="name" type="text" class="form-control form-control-search" id="name"
                                    placeholder="Company Name" />
                            </div>
                            <div class="location-group">
                                <div class="form-group">
                                    <select class="search-select2 country-select" name="country1" id="country1">
                                        <!-- Country options will be populated here -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="search-select2  state-select" name="state1" id="state1">
                                        <!-- State options will be populated here -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="search-select2 city-select" name="city1" id="city1">
                                        <!-- City options will be populated here -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="industry" type="text" class="form-control form-control-search"
                                    id="industry" placeholder="Industry" />
                            </div>

                            <hr />
                            <button class="btn btn-primary btn-search btn-block" type="submit">Search
                                Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-9 col-lg-8 col-md-6">

        <div class="row mb-4 py-2 card-header align-items-center justify-content-between">
            <div class="col-xl-7 col-lg-5 col-md-12">
                <h5 class="mb-0">Total Results: <span id="resultnum"></span></h5>
            </div>
            <div class="col-xl-5 col-lg-7 col-md-12 d-flex justify-content-end">
                <button class="select-all btn btn-secondary btn-icon-split mr-2">
                    <span class="icon text-white-50"><i class="fas fa-check-double"></i></span>
                    <span class="text">Select All</span>
                </button>
                <button class="multiple-save btn btn-primary btn-icon-split">
                    <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                    <span class="text">Add all to People</span>
                </button>
            </div>

        </div>

        <div class="m-5" id="loading" style="display:none">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                <!-- <div class="card shadow">
                    <div class="card-header p-0 d-flex flex-row align-items-center justify-content-between">
                        <div class="profileIntro d-flex flex-row align-items-center justify-content-between">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTYNYugbMm6TvFZYUDbOy_39-fiqdiiJE3p0Bq1OAhi8NWwafMcw5nG6LLT&s"
                                class="img-fluid" width="52px" height="auto" />
                            <h5 class="m-0 pl-3 text-uppercase font-weight-bold text-primary">John
                                Doe - Professor - University | LinkedIn</h5>
                        </div>
                        <div class="actionBtns d-flex flex-row align-items-center justify-content-between">
                            <a href="#" role="button" class="btn btn-circle mr-3"><i
                                    class="fas fa-plus fa-fw text-gray-400"></i></a>
                            <div class="form-group form-check mr-3">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Professor at University · Experience: University · Location: Clemson · 6
                            connections on LinkedIn. View John Doe's profile on LinkedIn, a
                            professional</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="infoBox mb-2">
                                    <div class="iconContainer">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <span class="d-inline mb-0">Job Title:
                                        <strong>Professor</strong></span>
                                </div>
                                <div class="infoBox mb-2">
                                    <div class="iconContainer">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <span class="d-inline mb-0">Job Title:
                                        <strong>Professor</strong></span>
                                </div>
                                <div class="infoBox">
                                    <div class="iconContainer">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <span class="d-inline mb-0">Job Title:
                                        <strong>Professor</strong></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="infoBox mb-2">
                                    <div class="iconContainer">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <span class="d-inline mb-0">Job Title:
                                        <strong>Professor</strong></span>
                                </div>
                                <div class="infoBox mb-2">
                                    <div class="iconContainer">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <span class="d-inline mb-0">Job Title:
                                        <strong>Professor</strong></span>
                                </div>
                                <div class="infoBox">
                                    <div class="iconContainer">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <span class="d-inline mb-0">Job Title:
                                        <strong>Professor</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="gcse-searchresults-only"></div>
            </div>



        </div>


    </div>
</div>

@endsection



@push('script')

<script>
(function() {
    var cx = 'f34fa06f1a5734984';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
})();
</script>
<script>
$(document).ready(function() {

    $('.submit-btn').click(function() {
        $('#profileSearch').submit();
    });


    function RemoveEle() {
        if ($('.gsc-control-cse .result-item').length > 0) {
            $('.gsc-control-cse').css({
                'background-color': 'white !important',
                'border': 'none !important'
            });
        } else {
            $('.gsc-control-cse').css({
                'background-color': 'none !important',
                'border': 'none !important'
            });
        }
        $('.gcsc-find-more-on-google').remove();
        $('#adBlock').remove();
        $('.gs-spelling').remove();
        // $('.gsc-above-wrapper-area').remove();
        // $('.gsc-search-box').hide();
        $('.gsc-above-wrapper-area').hide(); //hide total result and fitler by date

        $('.gsc-cursor-box.gs-bidi-start-align').addClass('text-center').css('font-size', '24px');
    }

    const intervalId = setInterval(RemoveEle, 1000);
});
</script>

<script>
var usersResults = [];

document.addEventListener("DOMContentLoaded", function() {
    var searchResults = [];

    let intervalId = setInterval(function() {
        var controlWrapper = document.querySelector('.gsc-control-wrapper-cse');
        if (controlWrapper) {
            controlWrapper.removeAttribute('style');
        }

        var searchBox = document.querySelector('.gsc-search-box');
        if (searchBox) {
            searchBox.removeAttribute('style');
        }
    }, 1000);
});

async function saveProfiles(profiles) {
    // Check if profiles is null or undefined
    if (!profiles) {
        return true;
    }

    // Check if profiles is an object or an array and if it is empty
    if (typeof profiles === 'object') {
        if (Array.isArray(profiles)) {
            // Check if array is empty
            if (profiles.length === 0) {
                return true;
            }
        } else {
            // Check if object is empty
            if (Object.keys(profiles).length === 0) {
                return true;
            }
        }
    } else {
        // If profiles is not an object or array, return true (consider it invalid)
        return true;
    }

    try {
        const response1 = await fetch("{{ route('api.saveSearchsLinkedindata') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(
                profiles) // Assuming `profiles` is an array or object containing the profiles
        });

        if (!profileResponse.ok) {
            throw new Error('Network response for profile was not ok');
        }
        const profileData = await profileResponse.json();

    } catch (error) {
        console.error('Error saving profile data:', error);
    }
}

function customizeSearchResults() {

    const profileDataArray = [];
    const results = document.querySelectorAll('.gsc-webResult.gsc-result');

    results.forEach(result => {
        const titleElement = result.querySelector('.gs-title a');
        const snippetElement = result.querySelector('.gs-snippet');
        const thumbnailElement = result.querySelector('.gs-image-box img');

        if (titleElement && snippetElement) {
            const title = titleElement.textContent || '';
            const link = titleElement.href || '';
            const username = extractUsernameFromLink(link);
            const vistUrl = `https://www.linkedin.com/in/${username}`;
            const snippet = snippetElement.innerHTML || '';
            const thumbnail = thumbnailElement ? thumbnailElement.src :
                '/assets/img/linkedin/defalt-profile.png';

            const customHtml = `
    <div class="mt-2">
        <div class="card shadow">
            <div class="card-header p-0 d-flex flex-row align-items-center justify-content-between">
                <div class="profileIntro d-flex flex-row align-items-center justify-content-between">
                    <img src="${thumbnail}" alt="User Image" class="img-fluid" width="52px" height="auto" />
                    <h5 class="m-0 pl-3 text-uppercase font-weight-bold text-primary"><a href="${vistUrl}" target="_blank">${title}</a></h5>
                </div>
                <div class="actionBtns d-flex flex-row align-items-center justify-content-between">
                    <a href="#" username="${username}" role="button" class="btn btn-circle mr-3 save-profile-btn"><i
                            class="fas fa-plus fa-fw text-gray-400"></i></a>
                    <div username="${username}" class="form-group form-check mr-3 multiple-selects">
                        <input class="form-check-input" type="checkbox">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>${snippet}</p>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="infoBox mb-2">
                            <div class="iconContainer">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <span class="d-inline mb-0"><strong>Job Title:</strong> Global Design Editor</span>
                        </div>
                        <div class="infoBox mb-2">
                            <div class="iconContainer">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="d-inline mb-0"><strong>Name:</strong> Mark Wilson</span>
                        </div>
                        <div class="infoBox mb-2">
                            <div class="iconContainer">
                                <i class="fas fa-building"></i>
                            </div>
                            <span class="d-inline mb-0"><strong>Company:</strong> Fast Company <strong>(Present)</strong></span>
                        </div>
                        <div class="infoBox">
                            <div class="iconContainer">
                                <i class="fas fa-industry"></i>
                            </div>
                            <span class="d-inline mb-0"><strong>Industry:</strong> Business media</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="infoBox mb-2">
                            <div class="iconContainer">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <span class="d-inline mb-0"><strong>Location:</strong> New York, NY 10007, United States</span>
                        </div>
                        <div class="infoBox mb-2">
                            <div class="iconContainer">
                                <i class="fas fa-globe"></i>
                            </div>
                            <span class="d-inline mb-0"><strong>Website:</strong> <a target="_blank" href="https://www.fastcompany.com">https://www.fastcompany.com</a></span>
                        </div>
                        <div class="infoBox mb-2">
                            <div class="iconContainer">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="d-inline mb-0"><strong>Followers:</strong> 10K</span>
                        </div>
                        <div class="infoBox">
                            <div class="iconContainer">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <span class="d-inline mb-0"><strong>Connections:</strong> 500+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
`;


            result.replaceWith(document.createRange().createContextualFragment(customHtml));
            profileDataArray.push({
                img: thumbnail,
                title: title,
                snippet: snippet,
                url: link
            });
        }
    });

    saveProfiles(profileDataArray);

}

function extractUsernameFromLink(link) {
    const usernameMatch = link.match(/\/in\/([^\/?]+)/);
    return usernameMatch ? usernameMatch[1] : '';
}

function delay(sec) {
    return new Promise((resolve, reject) => setTimeout(resolve, sec));
}

const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        if (mutation.addedNodes.length) {
            customizeSearchResults();
        }
    });
});

observer.observe(document.body, {
    childList: true,
    subtree: true
});

function constructLinkedInQuery() {
    const name = document.getElementById('name').value;
    let username = document.getElementById('username').value;
    const jobTitle = document.getElementById('jobTitle').value;
    const company = document.getElementById('company').value;



    let country = $('#country').val();
    const countryName = $('select[name="country"] option:selected').data('name');
    const stateName = $('select[name="state"] option:selected').data('name');
    const cityName = $('select[name="city"] option:selected').data('name');
    console.log('Selected Country:', countryName);
    console.log('Selected State:', stateName);
    console.log('Selected City:', cityName);

    country = country.toLowerCase();
    let query = '';
    if (country && country != 'us' && country != '0') {
        query += `site:${country}.linkedin.com/in/ `;
    } else {
        query += `site:linkedin.com/in/ `;
    }
    if (name) query += `  ${name} `;
    if (jobTitle) query += ` intitle:${jobTitle} `;
    if (company) query += `AND  ${company} `;
    if (countryName) query += ` AND  ${countryName} `;
    if (stateName) query += ` AND "${stateName}" `;
    if (cityName) query += ` AND "${cityName}" `;


    // query += ` | Company  | followers | connections`;
    console.log('Generated query:', query);
    return query.trim();
}

async function performSearch() {
    document.getElementById('loading').style.display = 'block';
    const searchQuery = constructLinkedInQuery();
    var gscInput = document.getElementById('gsc-i-id1');
    if (gscInput) {
        gscInput.value = searchQuery;
        var searchButton = document.querySelector('.gsc-search-button.gsc-search-button-v2');
        if (searchButton) {
            await delay(1000);
            searchButton.click();
            document.getElementById('loading').style.display = 'none';
            await delay(1000);
            $('#resultnum').text(ResultsNumber());

        }
    }
}

function ResultsNumber() {
    var resultText = $('.gsc-result-info').text();
    var resultCount = resultText.match(/About ([\d,]+) results/);
    if (resultCount && resultCount[1]) {
        console.log('nis', resultCount);
        return resultCount[1]; // Return the matched number
    } else {
        return null;
    }
}
</script>
@endpush



@push('script')
<script>
$(document).ready(function() {
    // Initialize select2 for all dropdowns
    $('.search-select2').select2();

    // Iterate over each location group to fetch and populate country data
    $('.location-group').each(function() {
        var countrySelect = $(this).find('.country-select');
        fetchCountries(countrySelect);
    });

    // Fetch and populate countries
    function fetchCountries(countrySelect) {
        $.ajax({
            url: 'https://api.countrystatecity.in/v1/countries',
            type: 'GET',
            headers: {
                "X-CSCAPI-KEY": "U2U4cjlsUmF4U2l4VXdaUDJHWVZOU1M0ZHhySnRLNWlGY2VwdkpRaw==" // Replace with your API key
            },
            success: function(countries) {
                countrySelect.empty(); // Clear existing options
                countrySelect.append('<option value="">Select Country</option>');
                $.each(countries, function(index, country) {
                    countrySelect.append($('<option>', {
                        value: country.iso2,
                        text: country.name,
                        'data-name': country.name // Add data-name attribute
                    }));
                });
                countrySelect.trigger('change');
            }
        });
    }

    // Handle country change event to load states
    $(document).on('change', '.country-select', function() {
        var countrySelect = $(this);
        var locationGroup = countrySelect.closest('.location-group');
        var stateSelect = locationGroup.find('.state-select');
        var citySelect = locationGroup.find('.city-select');

        var countryId = countrySelect.val();
        if (countryId) {
            fetchStates(countryId, stateSelect, citySelect);
        } else {
            stateSelect.empty().append('<option value="">Select State</option>').trigger('change');
            citySelect.empty().append('<option value="">Select City</option>').trigger('change');
        }
    });

    function fetchStates(countryId, stateSelect, citySelect) {
        $.ajax({
            url: `https://api.countrystatecity.in/v1/countries/${countryId}/states`,
            type: 'GET',
            headers: {
                "X-CSCAPI-KEY": "U2U4cjlsUmF4U2l4VXdaUDJHWVZOU1M0ZHhySnRLNWlGY2VwdkpRaw==" // Replace with your API key
            },
            success: function(states) {
                stateSelect.empty(); // Clear existing options
                stateSelect.append('<option value="">Select State</option>');
                $.each(states, function(index, state) {
                    stateSelect.append($('<option>', {
                        value: state.iso2,
                        text: state.name,
                        'data-name': state.name // Add data-name attribute
                    }));
                });
                stateSelect.trigger('change');
            }
        });
    }

    // Handle state change event to load cities
    $(document).on('change', '.state-select', function() {
        var stateSelect = $(this);
        var locationGroup = stateSelect.closest('.location-group');
        var citySelect = locationGroup.find('.city-select');

        var countryId = locationGroup.find('.country-select').val();
        var stateId = stateSelect.val();
        if (stateId && countryId) {
            fetchCities(countryId, stateId, citySelect);
        } else {
            citySelect.empty().append('<option value="">Select City</option>').trigger('change');
        }
    });

    function fetchCities(countryId, stateId, citySelect) {
        $.ajax({
            url: `https://api.countrystatecity.in/v1/countries/${countryId}/states/${stateId}/cities`,
            type: 'GET',
            headers: {
                "X-CSCAPI-KEY": "U2U4cjlsUmF4U2l4VXdaUDJHWVZOU1M0ZHhySnRLNWlGY2VwdkpRaw==" // Replace with your API key
            },
            success: function(cities) {
                citySelect.empty(); // Clear existing options
                citySelect.append('<option value="">Select City</option>');
                $.each(cities, function(index, city) {
                    citySelect.append($('<option>', {
                        value: city.id,
                        text: city.name,
                        'data-name': city.name // Add data-name attribute
                    }));
                });
                citySelect.trigger('change');
            }
        });
    }
});

$(document).on('click', '.save-profile-btn', function(e) {
    e.preventDefault(); // Prevent the default action

    // Get the username from the clicked button
    var username = $(this).attr('username');

    // Call the function to send the username to the API
    saveProfile(username, this);
});

function saveProfile(username, buttonElement) {
    fetch("{{ route('api.saveSelectedProfiles') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                username: username // Assuming `username` is a variable defined in your script
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) { // Check if 'success' is true
                $(buttonElement).html('<i class="fas fa-check" style="color: green;"></i>');
                $(buttonElement).removeClass('save-profile-btn');

            } else {
                // Handle unexpected success status
                throw new Error('Unexpected success status or message.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message);
        });
}

$(document).ready(function() {
    let selectedUsernames = [];

    // Function to handle checking/unchecking
    function updateSelection(username, isChecked) {
        if (isChecked) {
            if (!selectedUsernames.includes(username)) {
                selectedUsernames.push(username);
            }
        } else {
            selectedUsernames = selectedUsernames.filter(item => item !== username);
        }
        console.log('Selected Usernames:', selectedUsernames); // Debug statement
    }

    // Handle checkbox change event
    $(document).on('change', '.form-check-input', function() {
        const username = $(this).closest('.form-group').attr('username');
        updateSelection(username, $(this).is(':checked'));
    });

    // Handle "Select All" button click
    $(document).on('click', '.select-all', function() {
        $('.form-check-input').each(function() {
            $(this).prop('checked', true);
            const username = $(this).closest('.form-group').attr('username');
            updateSelection(username, true);
        });
    });

    // Handle "Add all to People" button click
    $(document).on('click', '.multiple-save', function() {
        console.log('Submitting:', selectedUsernames); // Debug statement
        $.ajax({
            url: "{{ route('api.saveMultipleselectedProfiles') }}", // Replace with your API endpoint
            method: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF Token for Laravel
            },
            data: JSON.stringify({
                usernames: selectedUsernames
            }),
            success: function(response) {
                // Handle successful response
                showToast('Saved successfully', 'success');
                // Optionally, reset the selection
                selectedUsernames = [];
                $('.form-check-input').prop('checked', false);
            },
            error: function(xhr, status, error) {
                // Extract error message from the response
                let errorMessage = 'Error saving data';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message; // Server-side error message
                } else if (xhr.statusText) {
                    errorMessage = xhr.statusText; // Client-side or network error message
                }
                showToast(errorMessage, 'danger');
            }
        });
    });
});
</script>


@endpush